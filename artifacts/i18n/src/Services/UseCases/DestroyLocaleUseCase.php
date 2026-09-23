<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\I18n\Services\UseCases;

use Ugarit\Artifacts\I18n\Contracts\LocaleRepositoryContract;
use Ugarit\Artifacts\I18n\Outcomes\I18nOutcome;

/**
 * Class DestroyLocaleUseCase
 *
 * Atomic UseCase responsible for removing a Locale record.
 */
class DestroyLocaleUseCase
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
     * Execute the deletion operation.
     *
     * @param  string  $code  Locale code to delete.
     * @return I18nOutcome Outcome reporting deletion result.
     */
    public function handle(string $code): I18nOutcome
    {
        // Attempt deletion through repository
        $deleted = $this->repository->delete($code);

        if (! $deleted) {
            return I18nOutcome::failure("Failed to delete locale [{$code}].");
        }

        return I18nOutcome::success(message: "Locale [{$code}] deleted successfully.");
    }
}
