<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\I18n\Models;

use Heritage\Database\Eloquent\Factories\HasFactory;
use Heritage\Database\Eloquent\Model;
use Heritage\Database\Eloquent\Relations\MorphTo;
/**
 * Class Translation
 *
 * Generic polymorphic translation dictionary record.
 *
 * Capabilities:
 * - Stores multilingual key-value translations for arbitrary domain entities.
 * - Supports polymorphic relationship mapping via translatable_type and translatable_id.
 * - Indexed by locale and attribute key for high-speed content lookup.
 *
 * @property int $id Unique primary key identifier.
 * @property string $translatable_type Fully qualified class name of the target entity.
 * @property int $translatable_id Primary key identifier of the target entity.
 * @property string $locale Target language/locale code (e.g. 'ar', 'en').
 * @property string $key Translatable attribute key name (e.g. 'name', 'bio').
 * @property string $value Localized string or text content.
 * @property \Heritage\Support\Carbon|null $created_at Timestamp of record creation.
 * @property \Heritage\Support\Carbon|null $updated_at Timestamp of last update.
 * @property-read Model $translatable Polymorphically associated target model instance.
 */
class Translation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'translatable_type',
        'translatable_id',
        'locale',
        'key',
        'value',
    ];

    /**
     * Define the polymorphic relation back to the parent translatable entity.
     *
     * @return MorphTo The polymorphic parent relation instance.
     */
    public function translatable(): MorphTo
    {
        // Polymorphically associate with parent model via translatable prefix
        return $this->morphTo();
    }
}
