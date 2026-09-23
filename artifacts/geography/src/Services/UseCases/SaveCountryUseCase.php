<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Services\UseCases;

use Ugarit\Artifacts\Geography\Contracts\CountryRepositoryContract;
use Ugarit\Artifacts\Geography\DTOs\SaveCountryDTO;
use Ugarit\Artifacts\Geography\Outcomes\GeographyOutcome;
use Ugarit\Artifacts\Geography\Signals\CountryCreatedSignal;

/**
 * Class SaveCountryUseCase
 *
 * Atomic UseCase responsible for persisting or updating a single Country record.
 */
class SaveCountryUseCase
{
    /**
     * Initialize the UseCase with its repository dependency.
     *
     * @param  CountryRepositoryContract  $repository  Country repository instance.
     */
    public function __construct(
        private readonly CountryRepositoryContract $repository
    ) {}

    /**
     * Execute the country persistence operation.
     *
     * @param  SaveCountryDTO  $dto  Country data transfer object.
     * @return GeographyOutcome Outcome containing the saved country.
     */
    public function handle(SaveCountryDTO $dto): GeographyOutcome
    {
        // Persist country entity through repository
        $saved = $this->repository->save($dto);

        // Dispatch domain signal event
        event(new CountryCreatedSignal($saved));

        // Return successful outcome envelope
        return GeographyOutcome::success(
            data: $saved->toArray(),
            message: "Country [{$saved->name}] saved successfully."
        );
    }
}
