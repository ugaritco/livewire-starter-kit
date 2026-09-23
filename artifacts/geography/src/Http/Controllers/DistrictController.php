<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Http\Controllers;

use Heritage\Http\Request;
use Ugarit\Artifacts\Geography\Contracts\DistrictRepositoryContract;
use Ugarit\Artifacts\Geography\DTOs\SaveDistrictDTO;
use Ugarit\Artifacts\Geography\Http\Responders\GeographyResponder;
use Ugarit\Artifacts\Geography\Outcomes\GeographyOutcome;
use Ugarit\Artifacts\Geography\Services\UseCases\IndexDistrictsUseCase;
use Ugarit\Artifacts\Geography\Services\UseCases\SaveDistrictUseCase;

/**
 * Class DistrictController
 *
 * Unified resource controller handling District / Neighborhood operations for both API and local Web applications.
 */
class DistrictController
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
     * Display a listing of districts, optionally filtered by city_id.
     *
     * @param  Request  $request  HTTP request.
     * @param  IndexDistrictsUseCase  $useCase  Districts retrieval use case.
     * @return mixed Standardized JSON or web response.
     */
    public function index(Request $request, IndexDistrictsUseCase $useCase): mixed
    {
        $cityId = $request->has('city_id') ? (int) $request->get('city_id') : null;

        return $this->responder->toResponse($useCase->handle($cityId));
    }

    /**
     * Show the form or schema for creating a new district.
     *
     * @return mixed Standardized response.
     */
    public function create(): mixed
    {
        return $this->responder->toResponse(GeographyOutcome::success([
            'schema' => [
                'city_id' => 'integer',
                'name' => 'string|array',
                'code' => 'string|nullable',
                'postal_code' => 'string|nullable',
                'is_active' => 'boolean',
            ],
        ]));
    }

    /**
     * Store a newly created district record.
     *
     * @param  Request  $request  HTTP request.
     * @param  SaveDistrictUseCase  $useCase  District persistence use case.
     * @return mixed Standardized response with 201 status code.
     */
    public function store(Request $request, SaveDistrictUseCase $useCase): mixed
    {
        $dto = SaveDistrictDTO::fromArray($request->all());

        return $this->responder->toResponse($useCase->handle($dto), 201);
    }

    /**
     * Display the specified district by ID.
     *
     * @param  int  $id  District primary key ID.
     * @param  DistrictRepositoryContract  $repo  District repository contract.
     * @return mixed Standardized response.
     */
    public function show(int $id, DistrictRepositoryContract $repo): mixed
    {
        $district = $repo->findById($id);

        if (! $district) {
            return $this->responder->toResponse(GeographyOutcome::failure("District [{$id}] not found."), 404);
        }

        return $this->responder->toResponse(GeographyOutcome::success($district->toArray()));
    }

    /**
     * Show the form for editing the specified district.
     *
     * @param  int  $id  District primary key ID.
     * @param  DistrictRepositoryContract  $repo  District repository contract.
     * @return mixed Standardized response.
     */
    public function edit(int $id, DistrictRepositoryContract $repo): mixed
    {
        return $this->show($id, $repo);
    }

    /**
     * Update the specified district in storage.
     *
     * @param  Request  $request  HTTP request.
     * @param  int  $id  District primary key ID.
     * @param  SaveDistrictUseCase  $useCase  District persistence use case.
     * @return mixed Standardized response.
     */
    public function update(Request $request, int $id, SaveDistrictUseCase $useCase): mixed
    {
        $data = $request->all();
        $data['id'] = $id;

        $dto = SaveDistrictDTO::fromArray($data);

        return $this->responder->toResponse($useCase->handle($dto));
    }

    /**
     * Remove the specified district from storage.
     *
     * @param  int  $id  District primary key ID.
     * @param  DistrictRepositoryContract  $repo  District repository contract.
     * @return mixed Standardized response.
     */
    public function destroy(int $id, DistrictRepositoryContract $repo): mixed
    {
        $deleted = $repo->delete($id);

        return $this->responder->toResponse(
            $deleted ? GeographyOutcome::success(['deleted' => true], "District [{$id}] deleted.") : GeographyOutcome::failure("Failed to delete district [{$id}].")
        );
    }
}
