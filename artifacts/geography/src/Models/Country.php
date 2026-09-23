<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Models;

use Heritage\Database\Eloquent\Factories\HasFactory;
use Heritage\Database\Eloquent\Model;
use Heritage\Database\Eloquent\Relations\HasMany;
use Ugarit\Artifacts\I18n\Traits\HasTranslatableAttributes;

/**
 * Class Country
 *
 * Represents a sovereign country entity within the Ugarit Geography ecosystem.
 *
 * Capabilities:
 * - Multilingual country naming with translation dictionary fallback.
 * - Standardized ISO-3166 alpha-2, alpha-3, and international telephony dial codes.
 * - One-to-many relationship with administrative governorates/provinces.
 *
 * @property int $id Unique primary key identifier.
 * @property string $name Official localized country name.
 * @property string $iso_alpha_2 Two-letter country code (ISO 3166-1 alpha-2).
 * @property string $iso_alpha_3 Three-letter country code (ISO 3166-1 alpha-3).
 * @property string|null $dial_code International phone dialing prefix.
 * @property string|null $currency_code Standard 3-letter currency code (ISO 4217).
 * @property string|null $flag_emoji Unicode emoji representation of the flag.
 * @property bool $is_active Operational activation flag.
 * @property \Heritage\Support\Carbon|null $created_at Timestamp of record creation.
 * @property \Heritage\Support\Carbon|null $updated_at Timestamp of last update.
 * @property-read \Heritage\Database\Eloquent\Collection<int, Governorate> $governorates Collection of child governorates.
 */
class Country extends Model
{
    use HasFactory, HasTranslatableAttributes;

    /**
     * The attributes that are translatable into multiple locales.
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
        'name',
        'iso_alpha_2',
        'iso_alpha_3',
        'dial_code',
        'currency_code',
        'flag_emoji',
        'is_active',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // Cast is_active attribute to boolean
        'is_active' => 'boolean',
    ];

    /**
     * Define a one-to-many relationship with child Governorate models.
     *
     * @return HasMany Collection of administrative governorates belonging to this country.
     */
    public function governorates(): HasMany
    {
        // Link to child governorates referencing country_id foreign key
        return $this->hasMany(Governorate::class, 'country_id');
    }
}
