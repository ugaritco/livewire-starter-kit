<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\I18n\Services\UseCases;

use Ugarit\Artifacts\I18n\Contracts\LanguageRepositoryContract;
use Ugarit\Artifacts\I18n\DTOs\SaveLanguageDTO;
use Ugarit\Artifacts\I18n\Outcomes\I18nOutcome;
use Ugarit\Artifacts\I18n\Signals\LanguageCreatedSignal;

/**
 * Class SaveLanguageUseCase
 *
 * Atomic UseCase responsible for persisting a single Language record.
 */
class SaveLanguageUseCase
{
    /**
     * Initialize the UseCase with its repository dependency.
     *
     * @param  LanguageRepositoryContract  $repository  Language repository instance.
     */
    public function __construct(
        private readonly LanguageRepositoryContract $repository
    ) {}

    /**
     * Execute the language persistence operation.
     *
     * @param  SaveLanguageDTO  $dto  Language persistence data.
     * @return I18nOutcome Outcome containing the saved language.
     */
    public function handle(SaveLanguageDTO $dto): I18nOutcome
    {
        // Persist language through repository
        $saved = $this->repository->save($dto);

        // Dispatch domain signal event
        event(new LanguageCreatedSignal($saved));

        // Return successful outcome
        return I18nOutcome::success(
            data: $saved->toArray(),
            message: "Language [{$saved->name}] saved successfully."
        );
    }
}
