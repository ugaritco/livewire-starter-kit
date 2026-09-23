<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Services\UseCases;

use Ugarit\Artifacts\Geography\Contracts\CityRepositoryContract;
use Ugarit\Artifacts\Geography\Outcomes\GeographyOutcome;

/**
 * Class IndexCitiesUseCase
 *
 * Handles retrieving cities, optionally filtered by parent governorate.
 */
class IndexCitiesUseCase
{
    /**
     * Initialize the UseCase with its repository dependency.
     *
     * @param  CityRepositoryContract  $repository  City repository instance.
     */
    public function __construct(
        private readonly CityRepositoryContract $repository
    ) {}

    /**
     * Execute the use case operation.
     *
     * @param  int|null  $governorateId  Optional parent governorate ID.
     * @return GeographyOutcome Outcome containing cities list.
     */
    public function handle(?int $governorateId = null): GeographyOutcome
    {
        // Query cities from repository
        $cities = $this->repository->all($governorateId);

        // Return successful outcome envelope
        return GeographyOutcome::success(
            data: $cities->map(fn ($dto) => $dto->toArray())->toArray()
        );
    }
}
