<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Http\Controllers;

use Heritage\Http\Request;
use Ugarit\Artifacts\Geography\Contracts\LocationRepositoryContract;
use Ugarit\Artifacts\Geography\DTOs\SaveLocationDTO;
use Ugarit\Artifacts\Geography\Http\Responders\GeographyResponder;
use Ugarit\Artifacts\Geography\Outcomes\GeographyOutcome;
use Ugarit\Artifacts\Geography\Services\UseCases\IndexLocationsUseCase;
use Ugarit\Artifacts\Geography\Services\UseCases\SaveLocationUseCase;

/**
 * Class LocationController
 *
 * Unified resource controller handling Location / Landmark operations for both API and local Web applications.
 */
class LocationController
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
     * Display a listing of locations, optionally filtered by city_id.
     *
     * @param  Request  $request  HTTP request.
     * @param  IndexLocationsUseCase  $useCase  Locations retrieval use case.
     * @return mixed Standardized JSON or web response.
     */
    public function index(Request $request, IndexLocationsUseCase $useCase): mixed
    {
        $cityId = $request->has('city_id') ? (int) $request->get('city_id') : null;

        return $this->responder->toResponse($useCase->handle($cityId));
    }

    /**
     * Show the form or schema for creating a new location.
     *
     * @return mixed Standardized response.
     */
    public function create(): mixed
    {
        return $this->responder->toResponse(GeographyOutcome::success([
            'schema' => [
                'city_id' => 'integer|nullable',
                'district_id' => 'integer|nullable',
                'name' => 'string|array',
                'latitude' => 'numeric|nullable',
                'longitude' => 'numeric|nullable',
                'address_line' => 'string|array|nullable',
                'postal_code' => 'string|nullable',
            ],
        ]));
    }

    /**
     * Store a newly created location record.
     *
     * @param  Request  $request  HTTP request.
     * @param  SaveLocationUseCase  $useCase  Location persistence use case.
     * @return mixed Standardized response with 201 status code.
     */
    public function store(Request $request, SaveLocationUseCase $useCase): mixed
    {
        $dto = SaveLocationDTO::fromArray($request->all());

        return $this->responder->toResponse($useCase->handle($dto), 201);
    }

    /**
     * Display the specified location by ID.
     *
     * @param  int  $id  Location primary key ID.
     * @param  LocationRepositoryContract  $repo  Location repository contract.
     * @return mixed Standardized response.
     */
    public function show(int $id, LocationRepositoryContract $repo): mixed
    {
        $location = $repo->findById($id);

        if (! $location) {
            return $this->responder->toResponse(GeographyOutcome::failure("Location [{$id}] not found."), 404);
        }

        return $this->responder->toResponse(GeographyOutcome::success($location->toArray()));
    }

    /**
     * Show the form for editing the specified location.
     *
     * @param  int  $id  Location primary key ID.
     * @param  LocationRepositoryContract  $repo  Location repository contract.
     * @return mixed Standardized response.
     */
    public function edit(int $id, LocationRepositoryContract $repo): mixed
    {
        return $this->show($id, $repo);
    }

    /**
     * Update the specified location in storage.
     *
     * @param  Request  $request  HTTP request.
     * @param  int  $id  Location primary key ID.
     * @param  SaveLocationUseCase  $useCase  Location persistence use case.
     * @return mixed Standardized response.
     */
    public function update(Request $request, int $id, SaveLocationUseCase $useCase): mixed
    {
        $data = $request->all();
        $data['id'] = $id;

        $dto = SaveLocationDTO::fromArray($data);

        return $this->responder->toResponse($useCase->handle($dto));
    }

    /**
     * Remove the specified location from storage.
     *
     * @param  int  $id  Location primary key ID.
     * @param  LocationRepositoryContract  $repo  Location repository contract.
     * @return mixed Standardized response.
     */
    public function destroy(int $id, LocationRepositoryContract $repo): mixed
    {
        $deleted = $repo->delete($id);

        return $this->responder->toResponse(
            $deleted ? GeographyOutcome::success(['deleted' => true], "Location [{$id}] deleted.") : GeographyOutcome::failure("Failed to delete location [{$id}].")
        );
    }
}
