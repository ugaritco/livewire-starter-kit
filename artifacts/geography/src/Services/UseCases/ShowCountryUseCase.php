<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Services\UseCases;

use Ugarit\Artifacts\Geography\Contracts\CountryRepositoryContract;
use Ugarit\Artifacts\Geography\Outcomes\GeographyOutcome;

/**
 * Class ShowCountryUseCase
 *
 * Handles finding a single country by its ISO code.
 */
class ShowCountryUseCase
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
     * Execute the country lookup.
     *
     * @param  string  $iso  Two or three letter ISO country code.
     * @return GeographyOutcome Outcome containing country data or failure.
     */
    public function handle(string $iso): GeographyOutcome
    {
        // Query country matching given ISO code
        $country = $this->repository->findByIso($iso);

        // Return failure if country does not exist
        if (! $country) {
            return GeographyOutcome::failure("Country with ISO [{$iso}] not found.");
        }

        // Return successful outcome with country payload
        return GeographyOutcome::success(data: $country->toArray());
    }
}
