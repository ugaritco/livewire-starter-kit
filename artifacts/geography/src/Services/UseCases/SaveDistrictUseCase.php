<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Services\UseCases;

use Ugarit\Artifacts\Geography\Contracts\DistrictRepositoryContract;
use Ugarit\Artifacts\Geography\DTOs\SaveDistrictDTO;
use Ugarit\Artifacts\Geography\Outcomes\GeographyOutcome;

/**
 * Class SaveDistrictUseCase
 *
 * Atomic UseCase responsible for persisting a single District / Neighborhood record.
 */
class SaveDistrictUseCase
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
     * Execute the district persistence operation.
     *
     * @param  SaveDistrictDTO  $dto  District data transfer object.
     * @return GeographyOutcome Outcome containing the saved district.
     */
    public function handle(SaveDistrictDTO $dto): GeographyOutcome
    {
        // Persist district through repository
        $saved = $this->repository->save($dto);

        // Return successful outcome
        return GeographyOutcome::success(
            data: $saved->toArray(),
            message: "District [{$saved->name}] saved successfully."
        );
    }
}
