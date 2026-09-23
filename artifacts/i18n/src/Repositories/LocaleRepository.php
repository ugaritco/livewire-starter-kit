<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\I18n\Repositories;

use Heritage\Support\Collection;
use Ugarit\Artifacts\I18n\Contracts\LocaleRepositoryContract;
use Ugarit\Artifacts\I18n\DTOs\LocaleDTO;
use Ugarit\Artifacts\I18n\DTOs\SaveLocaleDTO;
use Ugarit\Artifacts\I18n\Models\Locale;

/**
 * Class LocaleRepository
 *
 * Eloquent implementation of the LocaleRepositoryContract.
 */
class LocaleRepository implements LocaleRepositoryContract
{
    /**
     * Retrieve all active locales.
     *
     * @return Collection<int, LocaleDTO> Collection of LocaleDTO instances.
     */
    public function all(): Collection
    {
        // Fetch all active locales ordered by code and map to DTOs
        return Locale::query()
            ->where('is_active', true)
            ->orderBy('code', 'asc')
            ->get()
            ->map(fn (Locale $m) => LocaleDTO::fromArray($m->toArray()));
    }

    /**
     * Find a single locale by its code.
     *
     * @param  string  $code  Locale code.
     * @return LocaleDTO|null The locale DTO if found, or null otherwise.
     */
    public function findByCode(string $code): ?LocaleDTO
    {
        // Locate locale model by code
        $m = Locale::query()->where('code', strtolower($code))->first();

        return $m ? LocaleDTO::fromArray($m->toArray()) : null;
    }

    /**
     * Retrieve the system default locale.
     *
     * @return LocaleDTO|null The default locale DTO.
     */
    public function getDefault(): ?LocaleDTO
    {
        // Query the default locale
        $m = Locale::query()->where('is_default', true)->first();

        return $m ? LocaleDTO::fromArray($m->toArray()) : null;
    }

    /**
     * Persist or update a locale entity.
     *
     * @param  SaveLocaleDTO  $dto  Locale persistence DTO.
     * @return LocaleDTO The persisted locale DTO instance.
     */
    public function save(SaveLocaleDTO $dto): LocaleDTO
    {
        // Reset existing default if current is designated as default
        if ($dto->isDefault) {
            Locale::query()->where('is_default', true)->update(['is_default' => false]);
        }

        // Upsert locale record by unique code
        $m = Locale::query()->updateOrCreate(
            ['code' => $dto->code],
            $dto->toPersistenceArray()
        );

        return LocaleDTO::fromArray($m->toArray());
    }

    /**
     * Delete a locale by its code.
     *
     * @param  string  $code  Locale code to delete.
     * @return bool True if record was deleted, false otherwise.
     */
    public function delete(string $code): bool
    {
        // Execute delete statement on locale matching code
        return (bool) Locale::query()->where('code', strtolower($code))->delete();
    }
}
