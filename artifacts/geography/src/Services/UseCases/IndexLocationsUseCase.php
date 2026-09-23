<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Services\UseCases;

use Ugarit\Artifacts\Geography\Contracts\LocationRepositoryContract;
use Ugarit\Artifacts\Geography\Outcomes\GeographyOutcome;

/**
 * Class IndexLocationsUseCase
 *
 * Handles retrieving locations, optionally filtered by parent city.
 */
class IndexLocationsUseCase
{
    /**
     * Initialize the UseCase with its repository dependency.
     *
     * @param  LocationRepositoryContract  $repository  Location repository instance.
     */
    public function __construct(
        private readonly LocationRepositoryContract $repository
    ) {}

    /**
     * Execute the use case operation.
     *
     * @param  int|null  $cityId  Optional parent city ID.
     * @return GeographyOutcome Outcome containing locations list.
     */
    public function handle(?int $cityId = null): GeographyOutcome
    {
        // Query locations from repository
        $locations = $this->repository->all($cityId);

        // Return successful outcome envelope
        return GeographyOutcome::success(
            data: $locations->map(fn ($dto) => $dto->toArray())->toArray()
        );
    }
}
