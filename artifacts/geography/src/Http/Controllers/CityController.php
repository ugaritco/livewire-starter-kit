<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Http\Controllers;

use Heritage\Http\Request;
use Ugarit\Artifacts\Geography\Contracts\CityRepositoryContract;
use Ugarit\Artifacts\Geography\DTOs\SaveCityDTO;
use Ugarit\Artifacts\Geography\Http\Responders\GeographyResponder;
use Ugarit\Artifacts\Geography\Outcomes\GeographyOutcome;
use Ugarit\Artifacts\Geography\Services\UseCases\IndexCitiesUseCase;
use Ugarit\Artifacts\Geography\Services\UseCases\SaveCityUseCase;

/**
 * Class CityController
 *
 * Unified resource controller handling City operations for both API and local Web applications.
 */
class CityController
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
     * Display a listing of cities, optionally filtered by governorate_id.
     *
     * @param  Request  $request  HTTP request.
     * @param  IndexCitiesUseCase  $useCase  Cities retrieval use case.
     * @return mixed Standardized JSON or web response.
     */
    public function index(Request $request, IndexCitiesUseCase $useCase): mixed
    {
        $governorateId = $request->has('governorate_id') ? (int) $request->get('governorate_id') : null;

        return $this->responder->toResponse($useCase->handle($governorateId));
    }

    /**
     * Show the form or schema for creating a new city.
     *
     * @return mixed Standardized response.
     */
    public function create(): mixed
    {
        return $this->responder->toResponse(GeographyOutcome::success([
            'schema' => [
                'governorate_id' => 'integer',
                'name' => 'string|array',
                'postal_code' => 'string|nullable',
                'is_active' => 'boolean',
            ],
        ]));
    }

    /**
     * Store a newly created city record.
     *
     * @param  Request  $request  HTTP request.
     * @param  SaveCityUseCase  $useCase  City persistence use case.
     * @return mixed Standardized response with 201 status code.
     */
    public function store(Request $request, SaveCityUseCase $useCase): mixed
    {
        $dto = SaveCityDTO::fromArray($request->all());

        return $this->responder->toResponse($useCase->handle($dto), 201);
    }

    /**
     * Display the specified city by ID.
     *
     * @param  int  $id  City primary key ID.
     * @param  CityRepositoryContract  $repo  City repository contract.
     * @return mixed Standardized response.
     */
    public function show(int $id, CityRepositoryContract $repo): mixed
    {
        $city = $repo->findById($id);

        if (! $city) {
            return $this->responder->toResponse(GeographyOutcome::failure("City [{$id}] not found."), 404);
        }

        return $this->responder->toResponse(GeographyOutcome::success($city->toArray()));
    }

    /**
     * Show the form for editing the specified city.
     *
     * @param  int  $id  City primary key ID.
     * @param  CityRepositoryContract  $repo  City repository contract.
     * @return mixed Standardized response.
     */
    public function edit(int $id, CityRepositoryContract $repo): mixed
    {
        return $this->show($id, $repo);
    }

    /**
     * Update the specified city in storage.
     *
     * @param  Request  $request  HTTP request.
     * @param  int  $id  City primary key ID.
     * @param  SaveCityUseCase  $useCase  City persistence use case.
     * @return mixed Standardized response.
     */
    public function update(Request $request, int $id, SaveCityUseCase $useCase): mixed
    {
        $data = $request->all();
        $data['id'] = $id;

        $dto = SaveCityDTO::fromArray($data);

        return $this->responder->toResponse($useCase->handle($dto));
    }

    /**
     * Remove the specified city from storage.
     *
     * @param  int  $id  City primary key ID.
     * @param  CityRepositoryContract  $repo  City repository contract.
     * @return mixed Standardized response.
     */
    public function destroy(int $id, CityRepositoryContract $repo): mixed
    {
        $deleted = $repo->delete($id);

        return $this->responder->toResponse(
            $deleted ? GeographyOutcome::success(['deleted' => true], "City [{$id}] deleted.") : GeographyOutcome::failure("Failed to delete city [{$id}].")
        );
    }
}
