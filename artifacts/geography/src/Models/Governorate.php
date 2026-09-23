<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Models;

use Heritage\Database\Eloquent\Factories\HasFactory;
use Heritage\Database\Eloquent\Model;
use Heritage\Database\Eloquent\Relations\BelongsTo;
use Heritage\Database\Eloquent\Relations\HasMany;
use Ugarit\Artifacts\I18n\Traits\HasTranslatableAttributes;

/**
 * Class Governorate
 *
 * Represents an administrative governorate, province, or primary state subdivision.
 *
 * Capabilities:
 * - Multilingual translation resolution for governorate names.
 * - Relationship up to the sovereign Country model.
 * - Relationship down to subordinate City models.
 *
 * @property int $id Unique primary key identifier.
 * @property int $country_id Foreign key referencing parent country.
 * @property string $name Primary localized governorate/province name.
 * @property string|null $code Official administrative regional code.
 * @property bool $is_active Operational activation flag.
 * @property \Heritage\Support\Carbon|null $created_at Timestamp of record creation.
 * @property \Heritage\Support\Carbon|null $updated_at Timestamp of last update.
 * @property-read Country $country Parent country instance.
 * @property-read \Heritage\Database\Eloquent\Collection<int, City> $cities Collection of child cities.
 */
class Governorate extends Model
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
        'country_id',
        'name',
        'code',
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
     * Define an inverse one-to-many relationship with the parent Country model.
     *
     * @return BelongsTo The parent country relation instance.
     */
    public function country(): BelongsTo
    {
        // Associate with parent country via country_id
        return $this->belongsTo(Country::class, 'country_id');
    }

    /**
     * Define a one-to-many relationship with subordinate City models.
     *
     * @return HasMany Collection of cities within this governorate.
     */
    public function cities(): HasMany
    {
        // Link to child cities referencing governorate_id foreign key
        return $this->hasMany(City::class, 'governorate_id');
    }
}
