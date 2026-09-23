<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Services\UseCases;

use Ugarit\Artifacts\Geography\Contracts\GovernorateRepositoryContract;
use Ugarit\Artifacts\Geography\Outcomes\GeographyOutcome;

/**
 * Class IndexGovernoratesUseCase
 *
 * Handles retrieving governorates, optionally filtered by parent country.
 */
class IndexGovernoratesUseCase
{
    /**
     * Initialize the UseCase with its repository dependency.
     *
     * @param  GovernorateRepositoryContract  $repository  Governorate repository instance.
     */
    public function __construct(
        private readonly GovernorateRepositoryContract $repository
    ) {}

    /**
     * Execute the use case operation.
     *
     * @param  int|null  $countryId  Optional parent country ID.
     * @return GeographyOutcome Outcome containing governorates list.
     */
    public function handle(?int $countryId = null): GeographyOutcome
    {
        // Query governorates from repository
        $governorates = $this->repository->all($countryId);

        // Return successful outcome envelope
        return GeographyOutcome::success(
            data: $governorates->map(fn ($dto) => $dto->toArray())->toArray()
        );
    }
}
