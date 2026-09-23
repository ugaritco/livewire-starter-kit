<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\I18n\Traits;

use Ugarit\Artifacts\I18n\DTOs\LocaleDTO;

/**
 * Trait HasLocale
 *
 * Provides convenient accessors for models or classes that hold a locale association.
 */
trait HasLocale
{
    /**
     * Resolve the associated locale code.
     *
     * @return string Current locale code.
     */
    public function getLocaleCode(): string
    {
        // Return locale property or fallback to application locale
        return $this->locale ?? app()->getLocale();
    }

    /**
     * Check whether the entity is configured with a Right-to-Left (RTL) locale.
     *
     * @return bool True if RTL, false otherwise.
     */
    public function isRtlLocale(): bool
    {
        $code = $this->getLocaleCode();

        // Standard RTL languages check
        return in_array($code, ['ar', 'he', 'fa', 'ur'], true);
    }
}
