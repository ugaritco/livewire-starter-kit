<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\I18n\Http\Controllers;

use Heritage\Http\Request;
use Ugarit\Artifacts\I18n\DTOs\SaveLocaleDTO;
use Ugarit\Artifacts\I18n\Http\Responders\I18nResponder;
use Ugarit\Artifacts\I18n\Outcomes\I18nOutcome;
use Ugarit\Artifacts\I18n\Services\UseCases\DestroyLocaleUseCase;
use Ugarit\Artifacts\I18n\Services\UseCases\IndexLocalesUseCase;
use Ugarit\Artifacts\I18n\Services\UseCases\SaveLocaleUseCase;
use Ugarit\Artifacts\I18n\Services\UseCases\ShowLocaleUseCase;

/**
 * Class LocaleController
 *
 * Unified resource controller handling Locale operations for both API and local Web applications.
 */
class LocaleController
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
     * Display a listing of all active locales.
     *
     * @param  IndexLocalesUseCase  $useCase  Locales retrieval use case.
     * @return mixed Standardized JSON or web response.
     */
    public function index(IndexLocalesUseCase $useCase): mixed
    {
        return $this->responder->toResponse($useCase->handle());
    }

    /**
     * Show the form or schema for creating a new locale.
     *
     * @return mixed Standardized response.
     */
    public function create(): mixed
    {
        return $this->responder->toResponse(I18nOutcome::success([
            'schema' => [
                'code' => 'string(12)',
                'name' => 'string|array',
                'direction' => 'in:ltr,rtl',
                'script' => 'string|nullable',
                'regional' => 'string|nullable',
                'is_default' => 'boolean',
                'is_active' => 'boolean',
            ],
        ]));
    }

    /**
     * Store a newly created locale record.
     *
     * @param  Request  $request  HTTP request.
     * @param  SaveLocaleUseCase  $useCase  Locale persistence use case.
     * @return mixed Standardized response with 201 status code.
     */
    public function store(Request $request, SaveLocaleUseCase $useCase): mixed
    {
        $dto = SaveLocaleDTO::fromArray($request->all());

        return $this->responder->toResponse($useCase->handle($dto), 201);
    }

    /**
     * Display the specified locale by code.
     *
     * @param  string  $code  Locale code.
     * @param  ShowLocaleUseCase  $useCase  Locale lookup use case.
     * @return mixed Standardized response.
     */
    public function show(string $code, ShowLocaleUseCase $useCase): mixed
    {
        return $this->responder->toResponse($useCase->handle($code));
    }

    /**
     * Show the form for editing the specified locale.
     *
     * @param  string  $code  Locale code.
     * @param  ShowLocaleUseCase  $useCase  Locale lookup use case.
     * @return mixed Standardized response.
     */
    public function edit(string $code, ShowLocaleUseCase $useCase): mixed
    {
        return $this->show($code, $useCase);
    }

    /**
     * Update the specified locale in storage.
     *
     * @param  Request  $request  HTTP request.
     * @param  string  $code  Locale code.
     * @param  SaveLocaleUseCase  $useCase  Locale persistence use case.
     * @return mixed Standardized response.
     */
    public function update(Request $request, string $code, SaveLocaleUseCase $useCase): mixed
    {
        $data = $request->all();
        $data['code'] = $code;

        $dto = SaveLocaleDTO::fromArray($data);

        return $this->responder->toResponse($useCase->handle($dto));
    }

    /**
     * Remove the specified locale from storage.
     *
     * @param  string  $code  Locale code to delete.
     * @param  DestroyLocaleUseCase  $useCase  Locale deletion use case.
     * @return mixed Standardized response.
     */
    public function destroy(string $code, DestroyLocaleUseCase $useCase): mixed
    {
        return $this->responder->toResponse($useCase->handle($code));
    }
}
