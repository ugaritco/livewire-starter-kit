<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Http\Controllers;

use Heritage\Http\Request;
use Ugarit\Artifacts\Geography\Contracts\GovernorateRepositoryContract;
use Ugarit\Artifacts\Geography\DTOs\SaveGovernorateDTO;
use Ugarit\Artifacts\Geography\Http\Responders\GeographyResponder;
use Ugarit\Artifacts\Geography\Outcomes\GeographyOutcome;
use Ugarit\Artifacts\Geography\Services\UseCases\IndexGovernoratesUseCase;
use Ugarit\Artifacts\Geography\Services\UseCases\SaveGovernorateUseCase;

/**
 * Class GovernorateController
 *
 * Unified resource controller handling Governorate / Province operations for both API and local Web applications.
 */
class GovernorateController
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
     * Display a listing of governorates, optionally filtered by country_id.
     *
     * @param  Request  $request  HTTP request.
     * @param  IndexGovernoratesUseCase  $useCase  Governorates retrieval use case.
     * @return mixed Standardized JSON or web response.
     */
    public function index(Request $request, IndexGovernoratesUseCase $useCase): mixed
    {
        $countryId = $request->has('country_id') ? (int) $request->get('country_id') : null;

        return $this->responder->toResponse($useCase->handle($countryId));
    }

    /**
     * Show the form or schema for creating a new governorate.
     *
     * @return mixed Standardized response.
     */
    public function create(): mixed
    {
        return $this->responder->toResponse(GeographyOutcome::success([
            'schema' => [
                'country_id' => 'integer',
                'name' => 'string|array',
                'code' => 'string|nullable',
                'is_active' => 'boolean',
            ],
        ]));
    }

    /**
     * Store a newly created governorate record.
     *
     * @param  Request  $request  HTTP request.
     * @param  SaveGovernorateUseCase  $useCase  Governorate persistence use case.
     * @return mixed Standardized response with 201 status code.
     */
    public function store(Request $request, SaveGovernorateUseCase $useCase): mixed
    {
        $dto = SaveGovernorateDTO::fromArray($request->all());

        return $this->responder->toResponse($useCase->handle($dto), 201);
    }

    /**
     * Display the specified governorate by ID.
     *
     * @param  int  $id  Governorate primary key ID.
     * @param  GovernorateRepositoryContract  $repo  Governorate repository contract.
     * @return mixed Standardized response.
     */
    public function show(int $id, GovernorateRepositoryContract $repo): mixed
    {
        $governorate = $repo->findById($id);

        if (! $governorate) {
            return $this->responder->toResponse(GeographyOutcome::failure("Governorate [{$id}] not found."), 404);
        }

        return $this->responder->toResponse(GeographyOutcome::success($governorate->toArray()));
    }

    /**
     * Show the form for editing the specified governorate.
     *
     * @param  int  $id  Governorate primary key ID.
     * @param  GovernorateRepositoryContract  $repo  Governorate repository contract.
     * @return mixed Standardized response.
     */
    public function edit(int $id, GovernorateRepositoryContract $repo): mixed
    {
        return $this->show($id, $repo);
    }

    /**
     * Update the specified governorate in storage.
     *
     * @param  Request  $request  HTTP request.
     * @param  int  $id  Governorate primary key ID.
     * @param  SaveGovernorateUseCase  $useCase  Governorate persistence use case.
     * @return mixed Standardized response.
     */
    public function update(Request $request, int $id, SaveGovernorateUseCase $useCase): mixed
    {
        $data = $request->all();
        $data['id'] = $id;

        $dto = SaveGovernorateDTO::fromArray($data);

        return $this->responder->toResponse($useCase->handle($dto));
    }

    /**
     * Remove the specified governorate from storage.
     *
     * @param  int  $id  Governorate primary key ID.
     * @param  GovernorateRepositoryContract  $repo  Governorate repository contract.
     * @return mixed Standardized response.
     */
    public function destroy(int $id, GovernorateRepositoryContract $repo): mixed
    {
        $deleted = $repo->delete($id);

        return $this->responder->toResponse(
            $deleted ? GeographyOutcome::success(['deleted' => true], "Governorate [{$id}] deleted.") : GeographyOutcome::failure("Failed to delete governorate [{$id}].")
        );
    }
}
