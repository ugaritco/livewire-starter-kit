<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\I18n\Services\UseCases;

use Ugarit\Artifacts\I18n\Contracts\LocaleRepositoryContract;
use Ugarit\Artifacts\I18n\Outcomes\I18nOutcome;

/**
 * Class IndexLocalesUseCase
 *
 * Handles retrieving the complete listing of active locales.
 */
class IndexLocalesUseCase
{
    /**
     * Initialize the UseCase with its repository dependency.
     *
     * @param  LocaleRepositoryContract  $repository  Locale repository instance.
     */
    public function __construct(
        private readonly LocaleRepositoryContract $repository
    ) {}

    /**
     * Execute the use case operation.
     *
     * @return I18nOutcome Outcome containing the collection of locale DTOs.
     */
    public function handle(): I18nOutcome
    {
        // Fetch locales from repository
        $locales = $this->repository->all();

        // Return successful outcome envelope
        return I18nOutcome::success(
            data: $locales->map(fn ($dto) => $dto->toArray())->toArray()
        );
    }
}
