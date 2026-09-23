<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\I18n\Http\Controllers;

use Heritage\Http\Request;
use Ugarit\Artifacts\I18n\Contracts\LanguageRepositoryContract;
use Ugarit\Artifacts\I18n\DTOs\SaveLanguageDTO;
use Ugarit\Artifacts\I18n\Http\Responders\I18nResponder;
use Ugarit\Artifacts\I18n\Outcomes\I18nOutcome;
use Ugarit\Artifacts\I18n\Services\UseCases\IndexLanguagesUseCase;
use Ugarit\Artifacts\I18n\Services\UseCases\SaveLanguageUseCase;

/**
 * Class LanguageController
 *
 * Unified resource controller handling Language operations for both API and local Web applications.
 */
class LanguageController
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
     * Display a listing of all recognized languages.
     *
     * @param  IndexLanguagesUseCase  $useCase  Languages retrieval use case.
     * @return mixed Standardized JSON or web response.
     */
    public function index(IndexLanguagesUseCase $useCase): mixed
    {
        return $this->responder->toResponse($useCase->handle());
    }

    /**
     * Show the form or schema for creating a new language.
     *
     * @return mixed Standardized response.
     */
    public function create(): mixed
    {
        return $this->responder->toResponse(I18nOutcome::success([
            'schema' => [
                'iso_code' => 'string(12)',
                'name' => 'string|array',
                'native_name' => 'string',
                'is_active' => 'boolean',
            ],
        ]));
    }

    /**
     * Store a newly created language record.
     *
     * @param  Request  $request  HTTP request.
     * @param  SaveLanguageUseCase  $useCase  Language persistence use case.
     * @return mixed Standardized response with 201 status code.
     */
    public function store(Request $request, SaveLanguageUseCase $useCase): mixed
    {
        $dto = SaveLanguageDTO::fromArray($request->all());

        return $this->responder->toResponse($useCase->handle($dto), 201);
    }

    /**
     * Display the specified language by ISO code.
     *
     * @param  string  $isoCode  Language ISO code.
     * @param  LanguageRepositoryContract  $repo  Language repository contract.
     * @return mixed Standardized response.
     */
    public function show(string $isoCode, LanguageRepositoryContract $repo): mixed
    {
        $lang = $repo->findByIso($isoCode);

        if (! $lang) {
            return $this->responder->toResponse(I18nOutcome::failure("Language [{$isoCode}] not found."), 404);
        }

        return $this->responder->toResponse(I18nOutcome::success($lang->toArray()));
    }

    /**
     * Show the form for editing the specified language.
     *
     * @param  string  $isoCode  Language ISO code.
     * @param  LanguageRepositoryContract  $repo  Language repository contract.
     * @return mixed Standardized response.
     */
    public function edit(string $isoCode, LanguageRepositoryContract $repo): mixed
    {
        return $this->show($isoCode, $repo);
    }

    /**
     * Update the specified language in storage.
     *
     * @param  Request  $request  HTTP request.
     * @param  string  $isoCode  Language ISO code.
     * @param  SaveLanguageUseCase  $useCase  Language persistence use case.
     * @return mixed Standardized response.
     */
    public function update(Request $request, string $isoCode, SaveLanguageUseCase $useCase): mixed
    {
        $data = $request->all();
        $data['iso_code'] = $isoCode;

        $dto = SaveLanguageDTO::fromArray($data);

        return $this->responder->toResponse($useCase->handle($dto));
    }

    /**
     * Remove the specified language from storage.
     *
     * @param  string  $isoCode  Language ISO code.
     * @param  LanguageRepositoryContract  $repo  Language repository contract.
     * @return mixed Standardized response.
     */
    public function destroy(string $isoCode, LanguageRepositoryContract $repo): mixed
    {
        $lang = $repo->findByIso($isoCode);

        if (! $lang) {
            return $this->responder->toResponse(I18nOutcome::failure("Language [{$isoCode}] not found."), 404);
        }

        $deleted = $repo->delete($lang->id);

        return $this->responder->toResponse(
            $deleted ? I18nOutcome::success(['deleted' => true], "Language [{$isoCode}] deleted.") : I18nOutcome::failure("Failed to delete language [{$isoCode}].")
        );
    }
}
