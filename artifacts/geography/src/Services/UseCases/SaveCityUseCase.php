<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Services\UseCases;

use Ugarit\Artifacts\Geography\Contracts\CityRepositoryContract;
use Ugarit\Artifacts\Geography\DTOs\SaveCityDTO;
use Ugarit\Artifacts\Geography\Outcomes\GeographyOutcome;

/**
 * Class SaveCityUseCase
 *
 * Atomic UseCase responsible for persisting a single City record.
 */
class SaveCityUseCase
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
     * Execute the city persistence operation.
     *
     * @param  SaveCityDTO  $dto  City data transfer object.
     * @return GeographyOutcome Outcome containing the saved city.
     */
    public function handle(SaveCityDTO $dto): GeographyOutcome
    {
        // Persist city through repository
        $saved = $this->repository->save($dto);

        // Return successful outcome
        return GeographyOutcome::success(
            data: $saved->toArray(),
            message: "City [{$saved->name}] saved successfully."
        );
    }
}
