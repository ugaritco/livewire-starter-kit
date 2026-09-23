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
 * Class City
 *
 * Represents an administrative city or municipality belonging to a specific governorate.
 *
 * Capabilities:
 * - Multilingual translation resolution for city names via HasTranslatableAttributes.
 * - Belonging relationship linking each city to its parent governorate.
 *
 * @property int $id Unique primary key identifier.
 * @property int $governorate_id Foreign key reference to parent governorate.
 * @property string $name Primary default localized city name.
 * @property string|null $postal_code Official regional postal or zip code.
 * @property bool $is_active Operational activation flag.
 * @property \Heritage\Support\Carbon|null $created_at Timestamp of record creation.
 * @property \Heritage\Support\Carbon|null $updated_at Timestamp of last update.
 * @property-read Governorate $governorate Parent governorate instance.
 */
class City extends Model
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
        'governorate_id',
        'name',
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
     * Define an inverse one-to-many relationship with the parent Governorate model.
     *
     * @return BelongsTo The parent governorate relation instance.
     */
    public function governorate(): BelongsTo
    {
        // Associate the city with its parent governorate through governorate_id
        return $this->belongsTo(Governorate::class, 'governorate_id');
    }

    /**
     * Define a compound has-one-through relationship with the sovereign Country model.
     *
     * Enables direct traversal: City -> Governorate -> Country.
     *
     * @return HasOneThrough The country relation instance resolved through governorate.
     */
    public function country(): HasOneThrough
    {
        // Navigate to sovereign country through the intermediary Governorate model
        return $this->hasOneThrough(
            Country::class,
            Governorate::class,
            'id',             // Foreign key on governorates table
            'id',             // Foreign key on countries table
            'governorate_id', // Local key on cities table
            'country_id'      // Local key on governorates table
        );
    }

    /**
     * Define a one-to-many relationship with child District / Neighborhood models.
     *
     * @return HasMany Collection of districts within this city.
     */
    public function districts(): HasMany
    {
        // Link to child districts referencing city_id
        return $this->hasMany(District::class, 'city_id');
    }

    /**
     * Define a one-to-many relationship with physical Location records in this city.
     *
     * @return HasMany Collection of physical locations within this city.
     */
    public function locations(): HasMany
    {
        // Link to child locations referencing city_id
        return $this->hasMany(Location::class, 'city_id');
    }
}
