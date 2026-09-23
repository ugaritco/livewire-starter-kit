<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\I18n\Repositories;

use Heritage\Support\Collection;
use Ugarit\Artifacts\I18n\Contracts\LanguageRepositoryContract;
use Ugarit\Artifacts\I18n\DTOs\LanguageDTO;
use Ugarit\Artifacts\I18n\DTOs\SaveLanguageDTO;
use Ugarit\Artifacts\I18n\Models\Language;

/**
 * Class LanguageRepository
 *
 * Eloquent implementation of the LanguageRepositoryContract.
 */
class LanguageRepository implements LanguageRepositoryContract
{
    /**
     * Retrieve all recognized languages.
     *
     * @return Collection<int, LanguageDTO> Collection of LanguageDTO instances.
     */
    public function all(): Collection
    {
        // Query languages ordered alphabetically by name and transform to DTO collection
        return Language::query()
            ->orderBy('name', 'asc')
            ->get()
            ->map(fn (Language $m) => LanguageDTO::fromArray($m->toArray()));
    }

    /**
     * Find a language by its ISO-639 code.
     *
     * @param  string  $isoCode  Standard ISO code.
     * @return LanguageDTO|null The language DTO if found, or null otherwise.
     */
    public function findByIso(string $isoCode): ?LanguageDTO
    {
        // Locate language model by ISO code
        $m = Language::query()->where('iso_code', strtolower($isoCode))->first();

        return $m ? LanguageDTO::fromArray($m->toArray()) : null;
    }

    /**
     * Persist or update a language entity.
     *
     * @param  SaveLanguageDTO  $dto  Language persistence DTO.
     * @return LanguageDTO The persisted language DTO instance.
     */
    public function save(SaveLanguageDTO $dto): LanguageDTO
    {
        // Find existing language model or instantiate a fresh instance
        $m = $dto->id ? Language::query()->findOrFail($dto->id) : new Language();

        // Fill attributes from DTO and persist
        $m->fill($dto->toPersistenceArray());
        $m->save();

        return LanguageDTO::fromArray($m->toArray());
    }

    /**
     * Delete a language by its primary key ID.
     *
     * @param  int  $id  Language primary key ID to delete.
     * @return bool True if record was deleted, false otherwise.
     */
    public function delete(int $id): bool
    {
        // Execute delete statement on language matching ID
        return (bool) Language::query()->where('id', $id)->delete();
    }
}
