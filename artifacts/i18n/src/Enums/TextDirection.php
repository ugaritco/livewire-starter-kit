<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\I18n\Enums;

/**
 * Enum TextDirection
 *
 * Represents typographical text reading directions.
 */
enum TextDirection: string
{
    /**
     * Left-to-Right direction (Latin, Cyrillic, etc.).
     */
    case LTR = 'ltr';

    /**
     * Right-to-Left direction (Arabic, Ugaritic, Hebrew, etc.).
     */
    case RTL = 'rtl';

    /**
     * Check if the current direction is Right-to-Left.
     *
     * @return bool True if RTL, false otherwise.
     */
    public function isRtl(): bool
    {
        return $this === self::RTL;
    }
}
