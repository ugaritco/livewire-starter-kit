<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\I18n\Signals;

use Ugarit\Artifacts\I18n\DTOs\LanguageDTO;

/**
 * Class LanguageCreatedSignal
 *
 * Domain event signal dispatched upon the registration of a new Language entity.
 */
readonly class LanguageCreatedSignal
{
    /**
     * Initialize the signal with the created language DTO.
     *
     * @param  LanguageDTO  $language  The language DTO instance.
     */
    public function __construct(
        public LanguageDTO $language
    ) {}
}
