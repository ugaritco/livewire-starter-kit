<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Repositories;

use Heritage\Support\Collection;
use Ugarit\Artifacts\Geography\Contracts\CityRepositoryContract;
use Ugarit\Artifacts\Geography\DTOs\CityDTO;
use Ugarit\Artifacts\Geography\DTOs\SaveCityDTO;
use Ugarit\Artifacts\Geography\Models\City;

/**
 * Class CityRepository
 *
 * Eloquent implementation of the CityRepositoryContract.
 */
class CityRepository implements CityRepositoryContract
{
    /**
     * Retrieve all cities, optionally filtered by a parent governorate ID.
     *
     * @param  int|null  $governorateId  Optional governorate ID filter.
     * @return Collection<int, CityDTO> Collection of city DTO instances.
     */
    public function all(?int $governorateId = null): Collection
    {
        $query = City::query();

        // Apply governorate filter if provided
        if ($governorateId !== null) {
            $query->where('governorate_id', $governorateId);
        }

        // Fetch ordered cities and map to DTO collection
        return $query->orderBy('name', 'asc')
            ->get()
            ->map(fn (City $m) => CityDTO::fromArray($m->toArray()));
    }

    /**
     * Find a city by its primary key ID.
     *
     * @param  int  $id  City primary key ID.
     * @return CityDTO|null The city DTO if found, or null otherwise.
     */
    public function findById(int $id): ?CityDTO
    {
        // Query city by primary key ID
        $m = City::query()->find($id);

        return $m ? CityDTO::fromArray($m->toArray()) : null;
    }

    /**
     * Persist or update a city entity.
     *
     * @param  SaveCityDTO  $dto  City persistence data.
     * @return CityDTO The persisted city DTO instance.
     */
    public function save(SaveCityDTO $dto): CityDTO
    {
        // Locate existing city model or create a fresh instance
        $m = $dto->id ? City::query()->findOrFail($dto->id) : new City();

        // Fill attributes from DTO and persist
        $m->fill($dto->toPersistenceArray());
        $m->save();

        // Return mapped DTO representation
        return CityDTO::fromArray($m->toArray());
    }

    /**
     * Delete a city by its primary key ID.
     *
     * @param  int  $id  Primary key ID to delete.
     * @return bool True if record was deleted, false otherwise.
     */
    public function delete(int $id): bool
    {
        // Execute delete statement on city matching ID
        return (bool) City::query()->where('id', $id)->delete();
    }
}
