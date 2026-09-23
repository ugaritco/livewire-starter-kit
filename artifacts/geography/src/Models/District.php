<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Models;

use Heritage\Database\Eloquent\Factories\HasFactory;
use Heritage\Database\Eloquent\Model;
use Heritage\Database\Eloquent\Relations\BelongsTo;
use Heritage\Database\Eloquent\Relations\HasMany;
use Heritage\Database\Eloquent\Relations\HasOneThrough;
use Ugarit\Artifacts\I18n\Traits\HasTranslatableAttributes;

/**
 * Class District
 *
 * Represents an urban neighborhood, district, or municipal subdivision belonging to a City.
 *
 * Capabilities:
 * - Multilingual translation resolution for district names via HasTranslatableAttributes.
 * - Direct association with its parent City.
 * - Compound relationship navigating up to the parent Governorate (via City).
 * - Compound resolution navigating up to the sovereign Country (via Governorate).
 * - One-to-many relationship with physical Locations within this district.
 *
 * @property int $id Unique primary key identifier.
 * @property int $city_id Foreign key reference to parent city.
 * @property string $name Primary localized district/neighborhood name.
 * @property string|null $code Optional administrative district code.
 * @property string|null $postal_code Postal or zip code of the district.
 * @property bool $is_active Operational activation flag.
 * @property \Heritage\Support\Carbon|null $created_at Timestamp of record creation.
 * @property \Heritage\Support\Carbon|null $updated_at Timestamp of last update.
 * @property-read City $city Parent city instance.
 * @property-read Governorate|null $governorate Parent governorate resolved through city.
 * @property-read Country|null $country Sovereign country resolved through governorate.
 * @property-read \Heritage\Database\Eloquent\Collection<int, Location> $locations Physical locations situated in this district.
 */
class District extends Model
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
        'city_id',
        'name',
        'code',
        'postal_code',
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
     * Define an inverse one-to-many relationship with the parent City model.
     *
     * @return BelongsTo The parent city relation instance.
     */
    public function city(): BelongsTo
    {
        // Associate district with its parent city through city_id
        return $this->belongsTo(City::class, 'city_id');
    }

    /**
     * Define a compound has-one-through relationship with the parent Governorate model.
     *
     * Enables direct traversal: District -> City -> Governorate.
     *
     * @return HasOneThrough The governorate relation instance resolved through city.
     */
    public function governorate(): HasOneThrough
    {
        // Navigate to parent governorate through the intermediary City model
        return $this->hasOneThrough(
            Governorate::class,
            City::class,
            'id',             // Foreign key on cities table (referenced by local key)
            'id',             // Foreign key on governorates table (referenced by city)
            'city_id',        // Local key on districts table
            'governorate_id'  // Local key on cities table
        );
    }

    /**
     * Retrieve the sovereign Country associated with this district through its governorate.
     *
     * Enables multi-level compound traversal: District -> City -> Governorate -> Country.
     *
     * @return Country|null The sovereign country instance if resolved, null otherwise.
     */
    public function country(): ?Country
    {
        // Navigate through the governorate relation up to the sovereign country
        return $this->governorate?->country;
    }

    /**
     * Accessor to get the country attribute fluently ($district->country).
     *
     * @return Country|null The resolved country model.
     */
    public function getCountryAttribute(): ?Country
    {
        return $this->country();
    }

    /**
     * Define a one-to-many relationship with physical Location records situated in this district.
     *
     * @return HasMany Collection of physical locations within this district.
     */
    public function locations(): HasMany
    {
        // Link to child locations referencing district_id
        return $this->hasMany(Location::class, 'district_id');
    }
}
