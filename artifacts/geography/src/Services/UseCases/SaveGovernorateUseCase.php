<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Services\UseCases;

use Ugarit\Artifacts\Geography\Contracts\GovernorateRepositoryContract;
use Ugarit\Artifacts\Geography\DTOs\SaveGovernorateDTO;
use Ugarit\Artifacts\Geography\Outcomes\GeographyOutcome;

/**
 * Class SaveGovernorateUseCase
 *
 * Atomic UseCase responsible for persisting a single Governorate record.
 */
class SaveGovernorateUseCase
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
     * Execute the governorate persistence operation.
     *
     * @param  SaveGovernorateDTO  $dto  Governorate data transfer object.
     * @return GeographyOutcome Outcome containing the saved governorate.
     */
    public function handle(SaveGovernorateDTO $dto): GeographyOutcome
    {
        // Persist governorate through repository
        $saved = $this->repository->save($dto);

        // Return successful outcome
        return GeographyOutcome::success(
            data: $saved->toArray(),
            message: "Governorate [{$saved->name}] saved successfully."
        );
    }
}
