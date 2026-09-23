<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Services\UseCases;

use Ugarit\Artifacts\Geography\Contracts\DistrictRepositoryContract;
use Ugarit\Artifacts\Geography\Outcomes\GeographyOutcome;

/**
 * Class IndexDistrictsUseCase
 *
 * Handles retrieving districts, optionally filtered by parent city.
 */
class IndexDistrictsUseCase
{
    /**
     * Initialize the UseCase with its repository dependency.
     *
     * @param  DistrictRepositoryContract  $repository  District repository instance.
     */
    public function __construct(
        private readonly DistrictRepositoryContract $repository
    ) {}

    /**
     * Execute the use case operation.
     *
     * @param  int|null  $cityId  Optional parent city ID.
     * @return GeographyOutcome Outcome containing districts list.
     */
    public function handle(?int $cityId = null): GeographyOutcome
    {
        // Query districts from repository
        $districts = $this->repository->all($cityId);

        // Return successful outcome envelope
        return GeographyOutcome::success(
            data: $districts->map(fn ($dto) => $dto->toArray())->toArray()
        );
    }
}
