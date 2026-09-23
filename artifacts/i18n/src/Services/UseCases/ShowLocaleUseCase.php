<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\I18n\Services\UseCases;

use Ugarit\Artifacts\I18n\Contracts\LocaleRepositoryContract;
use Ugarit\Artifacts\I18n\Outcomes\I18nOutcome;

/**
 * Class ShowLocaleUseCase
 *
 * Handles finding a single locale by its code.
 */
class ShowLocaleUseCase
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
     * Execute the locale lookup.
     *
     * @param  string  $code  Locale code (e.g. 'ar', 'en').
     * @return I18nOutcome Outcome containing locale data or failure.
     */
    public function handle(string $code): I18nOutcome
    {
        // Query locale matching given code
        $locale = $this->repository->findByCode($code);

        // Return failure if locale does not exist
        if (! $locale) {
            return I18nOutcome::failure("Locale [{$code}] not found.");
        }

        // Return successful outcome with locale payload
        return I18nOutcome::success(data: $locale->toArray());
    }
}
