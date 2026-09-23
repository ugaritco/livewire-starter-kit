<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Services\UseCases;

use Ugarit\Artifacts\Geography\Contracts\CountryRepositoryContract;
use Ugarit\Artifacts\Geography\Outcomes\GeographyOutcome;

/**
 * Class IndexCountriesUseCase
 *
 * Handles retrieving the complete listing of registered countries.
 */
class IndexCountriesUseCase
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
     * Execute the use case operation.
     *
     * @return GeographyOutcome Outcome containing the collection of country DTOs.
     */
    public function handle(): GeographyOutcome
    {
        // Query all countries from repository
        $countries = $this->repository->all();

        // Return successful outcome envelope
        return GeographyOutcome::success(
            data: $countries->map(fn ($dto) => $dto->toArray())->toArray()
        );
    }
}
