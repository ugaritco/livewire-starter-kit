<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\I18n\Traits;

use Heritage\Database\Eloquent\Builder;
use Heritage\Database\Eloquent\Model;
use Heritage\Database\Eloquent\Relations\Relation;
use Ugarit\Artifacts\I18n\Models\Translation;

/**
 * Trait HasTranslatableAttributes
 *
 * Provides native polymorphic translation capabilities to Eloquent models.
 * Dynamically resolves localized attribute values for the active application locale,
 * manages fallback cascades, and automatically synchronizes with the translations table.
 */
trait HasTranslatableAttributes
{
    /**
     * In-memory cache of translations queued for saving upon model persistence.
     *
     * @var array<string, array<string, string>>
     */
    protected array $pendingTranslatableQueue = [];

    /**
     * Override save to ensure pending translations are saved even when model events are muted.
     *
     * @param  array<string, mixed>  $options  Save options.
     * @return bool
     */
    public function save(array $options = []): bool
    {
        $saved = parent::save($options);

        if ($saved) {
            $this->saveQueuedTranslations();
        }

        return $saved;
    }

    /**
     * Override delete to ensure polymorphic translations are cleaned up even when model events are muted.
     *
     * @return bool|null
     */
    public function delete(): ?bool
    {
        $deleted = parent::delete();

        if ($deleted) {
            try {
                $this->translations()->delete();
            } catch (\Throwable) {
            }
        }

        return $deleted;
    }

    /**
     * Boot the translatable attributes trait for the model.
     *
     * Registers model event hooks to persist pending translations upon save
     * and clean up orphaned translations upon deletion.
     *
     * @return void
     */
    public static function bootHasTranslatableAttributes(): void
    {
        static::saved(function (Model $model) {
            if (method_exists($model, 'saveQueuedTranslations')) {
                $model->saveQueuedTranslations();
            }
        });

        static::deleting(function (Model $model) {
            if (method_exists($model, 'translations')) {
                try {
                    $model->translations()->delete();
                } catch (\Throwable) {
                }
            }
        });
    }

    /**
     * Define the polymorphic one-to-many relationship with Translation records.
     *
     * @return Relation
     */
    public function translations(): Relation
    {
        return $this->morphMany(Translation::class, 'translatable');
    }

    /**
     * Get a translated attribute value overriding the framework default.
     *
     * @param  string  $key  Attribute name.
     * @param  string|null  $locale  Target locale code.
     * @return mixed
     */
    public function getTranslatedAttribute(string $key, ?string $locale = null): mixed
    {
        return $this->getTranslation($key, $locale);
    }

    /**
     * Get the fallback value for a translatable attribute directly from model attributes.
     *
     * @param  string  $key  Attribute name.
     * @return mixed
     */
    public function getTranslatableFallbackValue(string $key): mixed
    {
        return $this->attributes[$key] ?? null;
    }

    /**
     * Framework compatibility hook to save queued translations.
     *
     * @return void
     */
    public function savePendingTranslations(): void
    {
        $this->saveQueuedTranslations();
    }

    /**
     * Retrieve the array of translatable attribute names defined on the model.
     *
     * @return array<int, string>
     */
    public function getTranslatable(): array
    {
        return property_exists($this, 'translatable') ? (array) $this->translatable : [];
    }

    /**
     * Determine whether a given attribute key is registered as translatable.
     *
     * @param  string  $key  Attribute name.
     * @return bool
     */
    public function isTranslatableAttribute(string $key): bool
    {
        return in_array($key, $this->getTranslatable(), true);
    }

    /**
     * Override attribute resolution to automatically return localized content
     * when accessing translatable properties.
     *
     * @param  string  $key  Attribute name.
     * @return mixed
     */
    public function getAttribute($key): mixed
    {
        // Intercept translatable attributes
        if ($this->isTranslatableAttribute($key)) {
            $translated = $this->getTranslation($key);

            if ($translated !== null && $translated !== '') {
                return $translated;
            }
        }

        return parent::getAttribute($key);
    }

    /**
     * Override attribute assignment to support multilingual arrays or localized updates.
     *
     * @param  string  $key  Attribute name.
     * @param  mixed  $value  Raw string value or associative array of [locale => value].
     * @return mixed
     */
    public function setAttribute($key, $value): mixed
    {
        if ($this->isTranslatableAttribute($key)) {
            if (is_array($value)) {
                foreach ($value as $locale => $val) {
                    $this->setTranslation($key, (string) $val, (string) $locale);
                }

                // Store base column value as active locale, fallback locale, or first array element
                $currentLocale = app()->getLocale();
                $fallbackLocale = config('app.fallback_locale', 'en');
                $preferred = $value[$currentLocale] ?? $value[$fallbackLocale] ?? reset($value);

                $this->attributes[$key] = (string) $preferred;

                return $this;
            }

            // Sync current locale translation when a string is assigned
            $currentLocale = app()->getLocale();
            $this->setTranslation($key, (string) $value, $currentLocale);
            $this->attributes[$key] = (string) $value;

            return $this;
        }

        return parent::setAttribute($key, $value);
    }

    /**
     * Retrieve all translations for a given attribute or all attributes indexed by locale.
     *
     * @param  string|null  $key  Optional translatable attribute name.
     * @return array<string, mixed> Array of translations indexed by locale.
     */
    public function getTranslations(?string $key = null): array
    {
        $query = $this->translations();

        if ($key !== null) {
            $query->where('key', $key);
        }

        $results = [];

        foreach ($query->get() as $translation) {
            if ($key !== null) {
                $results[$translation->locale] = $translation->value;
            } else {
                $results[$translation->key][$translation->locale] = $translation->value;
            }
        }

        return $results;
    }

    /**
     * Assign multiple translations at once for a given attribute.
     *
     * @param  string  $key  Attribute key name.
     * @param  array<string, string>  $translations  Associative array of [locale => translation].
     * @return static
     */
    public function setTranslations(string $key, array $translations): static
    {
        foreach ($translations as $locale => $value) {
            $this->setTranslation($key, (string) $value, (string) $locale);
        }

        return $this;
    }

    /**
     * Retrieve a localized translation for a specific attribute key.
     *
     * @param  string  $key  Attribute key name.
     * @param  string|null  $locale  Target locale code (defaults to active application locale).
     * @param  bool  $useFallback  Whether to cascade to fallback locale if translation is missing.
     * @return mixed
     */
    public function getTranslation(string $key, ?string $locale = null, bool $useFallback = true): mixed
    {
        $targetLocale = $locale ?? app()->getLocale();

        // Check in-memory pending queue first
        if (isset($this->pendingTranslatableQueue[$targetLocale][$key])) {
            return $this->pendingTranslatableQueue[$targetLocale][$key];
        }

        // Query persisted translations relationship
        $match = $this->translations()
            ->where('locale', $targetLocale)
            ->where('key', $key)
            ->first();

        if ($match !== null && $match->value !== '') {
            return $match->value;
        }

        // Cascade fallback if requested
        if ($useFallback) {
            $fallbackLocale = config('app.fallback_locale', 'en');

            if ($targetLocale !== $fallbackLocale) {
                if (isset($this->pendingTranslatableQueue[$fallbackLocale][$key])) {
                    return $this->pendingTranslatableQueue[$fallbackLocale][$key];
                }

                $fallbackMatch = $this->translations()
                    ->where('locale', $fallbackLocale)
                    ->where('key', $key)
                    ->first();

                if ($fallbackMatch !== null && $fallbackMatch->value !== '') {
                    return $fallbackMatch->value;
                }
            }
        }

        return null;
    }

    /**
     * Set a localized translation for a specific attribute key.
     *
     * @param  string  $key  Attribute key name.
     * @param  mixed  $value  Translation value.
     * @param  string|null  $locale  Target locale code (defaults to active application locale).
     * @return static
     */
    public function setTranslation(string $key, mixed $value, ?string $locale = null): static
    {
        $targetLocale = $locale ?? app()->getLocale();

        // If the model exists in the database, persist immediately
        if ($this->exists) {
            $this->translations()->updateOrCreate(
                ['locale' => $targetLocale, 'key' => $key],
                ['value' => (string) $value]
            );
        } else {
            // Queue for persistence once the primary key is generated
            $this->pendingTranslatableQueue[$targetLocale][$key] = (string) $value;
        }

        return $this;
    }

    /**
     * Persist any translations queued in memory after model creation.
     *
     * @return void
     */
    public function saveQueuedTranslations(): void
    {
        if (empty($this->pendingTranslatableQueue)) {
            return;
        }

        foreach ($this->pendingTranslatableQueue as $locale => $attributes) {
            foreach ($attributes as $key => $value) {
                $this->translations()->updateOrCreate(
                    ['locale' => $locale, 'key' => $key],
                    ['value' => (string) $value]
                );
            }
        }

        $this->pendingTranslatableQueue = [];
    }

    /**
     * Scope query to records having a translation matching the given value.
     *
     * @param  Builder  $query  Query builder.
     * @param  string  $key  Translatable attribute name.
     * @param  mixed  $value  Expected translation value.
     * @param  string|null  $locale  Target locale.
     * @return Builder
     */
    public function scopeWhereTranslation(Builder $query, string $key, mixed $value, ?string $locale = null): Builder
    {
        $targetLocale = $locale ?? app()->getLocale();

        return $query->whereHas('translations', function (Builder $q) use ($key, $value, $targetLocale) {
            $q->where('key', $key)
                ->where('value', $value)
                ->where('locale', $targetLocale);
        });
    }

    /**
     * Scope query to records having a translation resembling the given pattern.
     *
     * @param  Builder  $query  Query builder.
     * @param  string  $key  Translatable attribute name.
     * @param  string  $pattern  SQL like pattern (e.g. '%term%').
     * @param  string|null  $locale  Target locale.
     * @return Builder
     */
    public function scopeWhereTranslationLike(Builder $query, string $key, string $pattern, ?string $locale = null): Builder
    {
        $targetLocale = $locale ?? app()->getLocale();

        return $query->whereHas('translations', function (Builder $q) use ($key, $pattern, $targetLocale) {
            $q->where('key', $key)
                ->where('value', 'like', $pattern)
                ->where('locale', $targetLocale);
        });
    }
}
