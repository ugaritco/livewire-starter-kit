<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\I18n\Services\UseCases;

use Ugarit\Artifacts\I18n\Contracts\LocaleRepositoryContract;
use Ugarit\Artifacts\I18n\DTOs\SaveLocaleDTO;
use Ugarit\Artifacts\I18n\Outcomes\I18nOutcome;
use Ugarit\Artifacts\I18n\Signals\LocaleChangedSignal;

/**
 * Class SaveLocaleUseCase
 *
 * Atomic UseCase responsible for persisting a single Locale record.
 */
class SaveLocaleUseCase
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
     * Execute the locale persistence operation.
     *
     * @param  SaveLocaleDTO  $dto  Locale persistence data.
     * @return I18nOutcome Outcome containing the saved locale.
     */
    public function handle(SaveLocaleDTO $dto): I18nOutcome
    {
        // Persist locale through repository
        $saved = $this->repository->save($dto);

        // Dispatch domain signal event
        event(new LocaleChangedSignal($saved));

        // Return successful outcome
        return I18nOutcome::success(
            data: $saved->toArray(),
            message: "Locale [{$saved->code}] saved successfully."
        );
    }
}
