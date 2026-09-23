<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\I18n\Signals;

use Ugarit\Artifacts\I18n\DTOs\LocaleDTO;

/**
 * Class LocaleChangedSignal
 *
 * Domain event signal dispatched when the system or session active locale is changed.
 */
readonly class LocaleChangedSignal
{
    /**
     * Initialize the signal with old and new locale DTOs.
     *
     * @param  LocaleDTO  $newLocale  The newly activated locale DTO.
     * @param  LocaleDTO|null  $previousLocale  The previously active locale DTO.
     */
    public function __construct(
        public LocaleDTO $newLocale,
        public ?LocaleDTO $previousLocale = null,
    ) {}
}
