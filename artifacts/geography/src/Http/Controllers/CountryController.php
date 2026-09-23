<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Http\Controllers;

use Heritage\Http\Request;
use Ugarit\Artifacts\Geography\Contracts\CountryRepositoryContract;
use Ugarit\Artifacts\Geography\DTOs\SaveCountryDTO;
use Ugarit\Artifacts\Geography\Http\Responders\GeographyResponder;
use Ugarit\Artifacts\Geography\Outcomes\GeographyOutcome;
use Ugarit\Artifacts\Geography\Services\UseCases\IndexCountriesUseCase;
use Ugarit\Artifacts\Geography\Services\UseCases\SaveCountryUseCase;
use Ugarit\Artifacts\Geography\Services\UseCases\ShowCountryUseCase;

/**
 * Class CountryController
 *
 * Unified resource controller handling Country operations for both RESTful API and local web applications.
 */
class CountryController
{
    /**
     * Initialize the controller with the specialized Geography responder.
     *
     * @param  GeographyResponder  $responder  HTTP responder instance.
     */
    public function __construct(
        private readonly GeographyResponder $responder
    ) {}

    /**
     * Display a listing of all registered countries.
     *
     * @param  IndexCountriesUseCase  $useCase  Countries retrieval use case.
     * @return mixed Standardized JSON or web response.
     */
    public function index(IndexCountriesUseCase $useCase): mixed
    {
        return $this->responder->toResponse($useCase->handle());
    }

    /**
     * Show the form or schema for creating a new country.
     *
     * @return mixed Standardized response.
     */
    public function create(): mixed
    {
        return $this->responder->toResponse(GeographyOutcome::success([
            'schema' => [
                'name' => 'string|array',
                'iso_alpha_2' => 'string(2)',
                'iso_alpha_3' => 'string(3)',
                'dial_code' => 'string',
                'currency_code' => 'string(3)',
                'flag_emoji' => 'string',
                'is_active' => 'boolean',
            ],
        ]));
    }

    /**
     * Store a newly created country record.
     *
     * @param  Request  $request  HTTP request instance.
     * @param  SaveCountryUseCase  $useCase  Country persistence use case.
     * @return mixed Standardized response.
     */
    public function store(Request $request, SaveCountryUseCase $useCase): mixed
    {
        $dto = SaveCountryDTO::fromArray($request->all());

        return $this->responder->toResponse($useCase->handle($dto), 201);
    }

    /**
     * Display the specified country by ISO code or primary ID.
     *
     * @param  string  $id  Country ISO code or ID.
     * @param  ShowCountryUseCase  $useCase  Country lookup use case.
     * @return mixed Standardized response.
     */
    public function show(string $id, ShowCountryUseCase $useCase): mixed
    {
        return $this->responder->toResponse($useCase->handle($id));
    }

    /**
     * Show the form for editing the specified country.
     *
     * @param  string  $id  Country ISO code or ID.
     * @param  ShowCountryUseCase  $useCase  Country lookup use case.
     * @return mixed Standardized response.
     */
    public function edit(string $id, ShowCountryUseCase $useCase): mixed
    {
        return $this->responder->toResponse($useCase->handle($id));
    }

    /**
     * Update the specified country in storage.
     *
     * @param  Request  $request  HTTP request instance.
     * @param  string  $id  Country ISO code or ID.
     * @param  SaveCountryUseCase  $useCase  Country persistence use case.
     * @return mixed Standardized response.
     */
    public function update(Request $request, string $id, SaveCountryUseCase $useCase): mixed
    {
        $data = $request->all();
        if (is_numeric($id)) {
            $data['id'] = (int) $id;
        } else {
            $data['iso_alpha_2'] = $id;
        }

        $dto = SaveCountryDTO::fromArray($data);

        return $this->responder->toResponse($useCase->handle($dto));
    }

    /**
     * Remove the specified country from storage.
     *
     * @param  string  $id  Country ISO code or ID.
     * @param  CountryRepositoryContract  $repo  Country repository contract.
     * @return mixed Standardized response.
     */
    public function destroy(string $id, CountryRepositoryContract $repo): mixed
    {
        $country = is_numeric($id) ? $repo->findById((int) $id) : $repo->findByIso($id);

        if (! $country) {
            return $this->responder->toResponse(GeographyOutcome::failure("Country [{$id}] not found."), 404);
        }

        $deleted = $repo->delete($country->id);

        return $this->responder->toResponse(
            $deleted ? GeographyOutcome::success(['deleted' => true], "Country [{$id}] deleted successfully.") : GeographyOutcome::failure("Failed to delete country [{$id}].")
        );
    }
}
