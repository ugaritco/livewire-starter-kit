<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Models;

use Heritage\Database\Eloquent\Factories\HasFactory;
use Heritage\Database\Eloquent\Model;
use Heritage\Database\Eloquent\Relations\BelongsTo;
use Heritage\Database\Eloquent\Relations\HasOneThrough;
use Ugarit\Artifacts\I18n\Traits\HasTranslatableAttributes;

/**
 * Class Location
 *
 * Represents a geographical point, physical address, branch, or coordinate site.
 *
 * Capabilities:
 * - Latitude and longitude coordinate persistence with native float casting.
 * - Multilingual translation resolution for localized place/branch names.
 * - Association with a parent City model.
 *
 * @property int $id Unique primary key identifier.
 * @property int|null $city_id Optional foreign key referencing parent city.
 * @property string $name Primary localized location or facility name.
 * @property float|null $latitude GPS latitude coordinate.
 * @property float|null $longitude GPS longitude coordinate.
 * @property string|null $address_line Detailed physical street address line.
 * @property string|null $postal_code Postal or zip code of the facility.
 * @property \Heritage\Support\Carbon|null $created_at Timestamp of record creation.
 * @property \Heritage\Support\Carbon|null $updated_at Timestamp of last update.
 * @property-read City|null $city Associated city model if present.
 */
class Location extends Model
{
    use HasFactory, HasTranslatableAttributes;

    /**
     * The attributes that can be localized and translated.
     *
     * @var array<int, string>
     */
    protected array $translatable = [
        'name',
        'address_line',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'city_id',
        'district_id',
        'name',
        'latitude',
        'longitude',
        'address_line',
        'postal_code',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // Cast latitude to floating-point number
        'latitude' => 'float',
        // Cast longitude to floating-point number
        'longitude' => 'float',
    ];

    /**
     * Define an inverse one-to-many relationship with the parent City model.
     *
     * @return BelongsTo The parent city relation instance.
     */
    public function city(): BelongsTo
    {
        // Associate location with parent city through city_id
        return $this->belongsTo(City::class, 'city_id');
    }

    /**
     * Define an inverse one-to-many relationship with the parent District model.
     *
     * @return BelongsTo The parent district relation instance.
     */
    public function district(): BelongsTo
    {
        // Associate location with parent district through district_id
        return $this->belongsTo(District::class, 'district_id');
    }

    /**
     * Define a compound has-one-through relationship with the parent Governorate model.
     *
     * Enables direct traversal: Location -> City -> Governorate.
     *
     * @return HasOneThrough The governorate relation instance resolved through city.
     */
    public function governorate(): HasOneThrough
    {
        // Navigate to parent governorate through the intermediary City model
        return $this->hasOneThrough(
            Governorate::class,
            City::class,
            'id',             // Foreign key on cities table
            'id',             // Foreign key on governorates table
            'city_id',        // Local key on locations table
            'governorate_id'  // Local key on cities table
        );
    }

    /**
     * Retrieve the sovereign Country associated with this location through its city and governorate.
     *
     * Enables multi-level compound traversal: Location -> City -> Governorate -> Country.
     *
     * @return Country|null The sovereign country instance if resolved, null otherwise.
     */
    public function country(): ?Country
    {
        // Navigate through parent city relation up to the sovereign country
        return $this->city?->country;
    }

    /**
     * Accessor to get the country attribute fluently ($location->country).
     *
     * @return Country|null The resolved country model.
     */
    public function getCountryAttribute(): ?Country
    {
        return $this->country();
    }
}
