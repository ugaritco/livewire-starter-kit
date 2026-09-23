<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Services\UseCases;

use Ugarit\Artifacts\Geography\Contracts\LocationRepositoryContract;
use Ugarit\Artifacts\Geography\DTOs\SaveLocationDTO;
use Ugarit\Artifacts\Geography\Outcomes\GeographyOutcome;
use Ugarit\Artifacts\Geography\Signals\LocationCreatedSignal;

/**
 * Class SaveLocationUseCase
 *
 * Atomic UseCase responsible for persisting a single Location record.
 */
class SaveLocationUseCase
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
     * Execute the location persistence operation.
     *
     * @param  SaveLocationDTO  $dto  Location data transfer object.
     * @return GeographyOutcome Outcome containing the saved location.
     */
    public function handle(SaveLocationDTO $dto): GeographyOutcome
    {
        // Persist location through repository
        $saved = $this->repository->save($dto);

        // Dispatch domain signal event
        event(new LocationCreatedSignal($saved));

        // Return successful outcome
        return GeographyOutcome::success(
            data: $saved->toArray(),
            message: "Location [{$saved->name}] saved successfully."
        );
    }
}
