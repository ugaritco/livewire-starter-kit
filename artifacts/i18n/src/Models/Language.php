<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\I18n\Models;

use Heritage\Database\Eloquent\Factories\HasFactory;
use Heritage\Database\Eloquent\Model;
use Ugarit\Artifacts\I18n\Traits\HasTranslatableAttributes;

/**
 * Class Language
 *
 * Represents a recognized world language definition within the Ugarit system.
 *
 * Capabilities:
 * - Stores ISO-639 standard language codes.
 * - Maintains both international and native language denominations.
 * - Controls whether a language is globally active for content translation.
 *
 * @property int $id Unique primary key identifier.
 * @property string $iso_code Standard ISO-639 language code (e.g. 'ar', 'en').
 * @property string $name International English name of the language.
 * @property string $native_name Autonym / native denomination in the original language.
 * @property bool $is_active Operational activation flag.
 * @property \Heritage\Support\Carbon|null $created_at Timestamp of record creation.
 * @property \Heritage\Support\Carbon|null $updated_at Timestamp of last update.
 */
class Language extends Model
{
    use HasFactory, HasTranslatableAttributes;

    /**
     * The attributes that can be localized and translated.
     *
     * @var array<int, string>
     */
    protected array $translatable = [
        'name',
        'native_name',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'iso_code',
        'name',
        'native_name',
        'is_active',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // Cast is_active flag to boolean
        'is_active' => 'boolean',
    ];
}
