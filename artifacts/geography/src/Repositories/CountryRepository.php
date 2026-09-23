<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Repositories;

use Heritage\Support\Collection;
use Ugarit\Artifacts\Geography\Contracts\CountryRepositoryContract;
use Ugarit\Artifacts\Geography\DTOs\CountryDTO;
use Ugarit\Artifacts\Geography\DTOs\SaveCountryDTO;
use Ugarit\Artifacts\Geography\Models\Country;

/**
 * Class CountryRepository
 *
 * Eloquent implementation of the CountryRepositoryContract.
 */
class CountryRepository implements CountryRepositoryContract
{
    /**
     * Retrieve all registered countries ordered alphabetically by name.
     *
     * @return Collection<int, CountryDTO> Collection of CountryDTO instances.
     */
    public function all(): Collection
    {
        // Query countries ordered alphabetically and map each model into a DTO
        return Country::query()
            ->orderBy('name', 'asc')
            ->get()
            ->map(fn (Country $m) => CountryDTO::fromArray($m->toArray()));
    }

    /**
     * Find a single country by its primary key ID.
     *
     * @param  int  $id  Primary key ID.
     * @return CountryDTO|null The country DTO if found, or null otherwise.
     */
    public function findById(int $id): ?CountryDTO
    {
        // Locate country model by primary key ID
        $m = Country::query()->find($id);

        return $m ? CountryDTO::fromArray($m->toArray()) : null;
    }

    /**
     * Find a country by either its ISO alpha-2 or alpha-3 code.
     *
     * @param  string  $iso  Two or three letter ISO code.
     * @return CountryDTO|null The country DTO if found, or null otherwise.
     */
    public function findByIso(string $iso): ?CountryDTO
    {
        // Query country matching either uppercase alpha-2 or alpha-3 code
        $m = Country::query()
            ->where('iso_alpha_2', strtoupper($iso))
            ->orWhere('iso_alpha_3', strtoupper($iso))
            ->first();

        return $m ? CountryDTO::fromArray($m->toArray()) : null;
    }

    /**
     * Persist or update a country entity from a SaveCountryDTO.
     *
     * @param  SaveCountryDTO  $dto  The country persistence data.
     * @return CountryDTO The persisted country DTO instance.
     */
    public function save(SaveCountryDTO $dto): CountryDTO
    {
        // Find existing country model or instantiate a new one
        $m = $dto->id ? Country::query()->findOrFail($dto->id) : new Country();

        // Fill model attributes and persist to database
        $m->fill($dto->toPersistenceArray());
        $m->save();

        // Return mapped DTO representation
        return CountryDTO::fromArray($m->toArray());
    }

    /**
     * Delete a country entity by its primary key ID.
     *
     * @param  int  $id  Primary key ID to delete.
     * @return bool True if record was deleted, false otherwise.
     */
    public function delete(int $id): bool
    {
        // Execute delete statement on country matching ID
        return (bool) Country::query()->where('id', $id)->delete();
    }
}
