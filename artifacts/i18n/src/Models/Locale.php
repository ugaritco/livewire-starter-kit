<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\I18n\Models;

use Heritage\Database\Eloquent\Factories\HasFactory;
use Heritage\Database\Eloquent\Model;
use Ugarit\Artifacts\I18n\Traits\HasTranslatableAttributes;

/**
 * Class Locale
 *
 * Represents an active locale configuration within the Ugarit system.
 *
 * Capabilities:
 * - Directs regional text directionality (RTL / LTR).
 * - Identifies regional scripts, dialects, and default active flags.
 *
 * @property int $id Unique primary key identifier.
 * @property string $code Standard locale code (e.g. 'ar', 'en', 'fr').
 * @property string $name Descriptive localized name of the locale.
 * @property string $direction Text reading direction ('ltr' or 'rtl').
 * @property string|null $script Writing script classification (e.g. 'Arab', 'Latn').
 * @property string|null $regional Regional locale code (e.g. 'ar_SA', 'en_US').
 * @property bool $is_default System default locale indicator.
 * @property bool $is_active Operational activation flag.
 * @property \Heritage\Support\Carbon|null $created_at Timestamp of record creation.
 * @property \Heritage\Support\Carbon|null $updated_at Timestamp of last update.
 */
class Locale extends Model
{
    use HasFactory, HasTranslatableAttributes;

    /**
     * The attributes that can be localized and translated.
     *
     * @var array<int, string>
     */
    protected array $translatable = [
        'name',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'name',
        'direction',
        'script',
        'regional',
        'is_default',
        'is_active',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // Cast is_default flag to boolean
        'is_default' => 'boolean',
        // Cast is_active flag to boolean
        'is_active' => 'boolean',
    ];
}
