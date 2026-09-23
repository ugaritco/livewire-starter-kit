<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\I18n\Http\Controllers;

use Heritage\Http\JsonResponse;
use Heritage\Http\Request;
use Ugarit\Artifacts\I18n\Http\Responders\I18nResponder;
use Ugarit\Artifacts\I18n\Models\Translation;
use Ugarit\Artifacts\I18n\Outcomes\I18nOutcome;

/**
 * Class TranslationController
 *
 * RESTful HTTP resource controller managing polymorphic content translations.
 */
class TranslationController
{
    /**
     * Initialize the controller with the specialized I18n responder.
     *
     * @param  I18nResponder  $responder  HTTP responder instance.
     */
    public function __construct(
        private readonly I18nResponder $responder
    ) {}

    /**
     * Retrieve a filtered list of translations.
     *
     * @param  Request  $request  HTTP request.
     * @return JsonResponse Standardized JSON response.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Translation::query();

        if ($request->has('locale')) {
            $query->where('locale', $request->query('locale'));
        }

        if ($request->has('translatable_type')) {
            $query->where('translatable_type', $request->query('translatable_type'));
        }

        if ($request->has('key')) {
            $query->where('key', $request->query('key'));
        }

        $translations = $query->paginate(50);

        return $this->responder->toResponse(I18nOutcome::success($translations->toArray()));
    }

    /**
     * Show the form or schema for creating a new translation.
     *
     * @return mixed Standardized response.
     */
    public function create(): mixed
    {
        return $this->responder->toResponse(I18nOutcome::success([
            'schema' => [
                'translatable_type' => 'string',
                'translatable_id' => 'integer',
                'locale' => 'string(12)',
                'key' => 'string',
                'value' => 'string',
            ],
        ]));
    }

    /**
     * Store a new translation entry.
     *
     * @param  Request  $request  HTTP request.
     * @return mixed Standardized response with 201 status.
     */
    public function store(Request $request): mixed
    {
        $data = $request->validate([
            'translatable_type' => 'required|string',
            'translatable_id' => 'required|integer',
            'locale' => 'required|string|max:12',
            'key' => 'required|string',
            'value' => 'required|string',
        ]);

        $translation = Translation::updateOrCreate(
            [
                'translatable_type' => $data['translatable_type'],
                'translatable_id' => $data['translatable_id'],
                'locale' => $data['locale'],
                'key' => $data['key'],
            ],
            ['value' => $data['value']]
        );

        return $this->responder->toResponse(I18nOutcome::success($translation->toArray()), 201);
    }

    /**
     * Display the specified translation.
     *
     * @param  int  $id  Primary key identifier.
     * @return mixed Standardized response.
     */
    public function show(int $id): mixed
    {
        $translation = Translation::find($id);

        if (! $translation) {
            return $this->responder->toResponse(I18nOutcome::failure("Translation [{$id}] not found."), 404);
        }

        return $this->responder->toResponse(I18nOutcome::success($translation->toArray()));
    }

    /**
     * Show the form for editing the specified translation.
     *
     * @param  int  $id  Primary key identifier.
     * @return mixed Standardized response.
     */
    public function edit(int $id): mixed
    {
        return $this->show($id);
    }

    /**
     * Update the specified translation.
     *
     * @param  Request  $request  HTTP request.
     * @param  int  $id  Primary key identifier.
     * @return JsonResponse Standardized JSON response.
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $translation = Translation::find($id);

        if (! $translation) {
            return $this->responder->toResponse(I18nOutcome::failure("Translation [{$id}] not found."), 404);
        }

        $data = $request->validate([
            'value' => 'required|string',
        ]);

        $translation->update($data);

        return $this->responder->toResponse(I18nOutcome::success($translation->toArray()));
    }

    /**
     * Delete the specified translation.
     *
     * @param  int  $id  Primary key identifier.
     * @return JsonResponse Standardized JSON response.
     */
    public function destroy(int $id): JsonResponse
    {
        $translation = Translation::find($id);

        if (! $translation) {
            return $this->responder->toResponse(I18nOutcome::failure("Translation [{$id}] not found."), 404);
        }

        $translation->delete();

        return $this->responder->toResponse(I18nOutcome::success(['deleted' => true]));
    }
}
