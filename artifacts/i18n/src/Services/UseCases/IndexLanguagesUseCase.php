<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\I18n\Services\UseCases;

use Ugarit\Artifacts\I18n\Contracts\LanguageRepositoryContract;
use Ugarit\Artifacts\I18n\Outcomes\I18nOutcome;

/**
 * Class IndexLanguagesUseCase
 *
 * Handles retrieving the complete listing of recognized languages.
 */
class IndexLanguagesUseCase
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
     * Execute the use case operation.
     *
     * @return I18nOutcome Outcome containing languages list.
     */
    public function handle(): I18nOutcome
    {
        // Query all languages from repository
        $languages = $this->repository->all();

        // Return successful outcome envelope
        return I18nOutcome::success(
            data: $languages->map(fn ($dto) => $dto->toArray())->toArray()
        );
    }
}
