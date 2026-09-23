<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Repositories;

use Heritage\Support\Collection;
use Ugarit\Artifacts\Geography\Contracts\LocationRepositoryContract;
use Ugarit\Artifacts\Geography\DTOs\LocationDTO;
use Ugarit\Artifacts\Geography\DTOs\SaveLocationDTO;
use Ugarit\Artifacts\Geography\Models\Location;

/**
 * Class LocationRepository
 *
 * Eloquent implementation of the LocationRepositoryContract.
 */
class LocationRepository implements LocationRepositoryContract
{
    /**
     * Retrieve all locations, optionally filtered by a parent city ID.
     *
     * @param  int|null  $cityId  Optional city ID filter.
     * @return Collection<int, LocationDTO> Collection of location DTO instances.
     */
    public function all(?int $cityId = null): Collection
    {
        $query = Location::query();

        // Apply city filter if provided
        if ($cityId !== null) {
            $query->where('city_id', $cityId);
        }

        // Fetch ordered locations and map to DTO collection
        return $query->orderBy('name', 'asc')
            ->get()
            ->map(fn (Location $m) => LocationDTO::fromArray($m->toArray()));
    }

    /**
     * Find a location by its primary key ID.
     *
     * @param  int  $id  Location primary key ID.
     * @return LocationDTO|null The location DTO if found, or null otherwise.
     */
    public function findById(int $id): ?LocationDTO
    {
        // Query location by primary key ID
        $m = Location::query()->find($id);

        return $m ? LocationDTO::fromArray($m->toArray()) : null;
    }

    /**
     * Persist or update a location entity.
     *
     * @param  SaveLocationDTO  $dto  Location persistence data.
     * @return LocationDTO The persisted location DTO instance.
     */
    public function save(SaveLocationDTO $dto): LocationDTO
    {
        // Locate existing location model or instantiate a new one
        $m = $dto->id ? Location::query()->findOrFail($dto->id) : new Location();

        // Fill attributes from DTO and persist
        $m->fill($dto->toPersistenceArray());
        $m->save();

        // Return mapped DTO representation
        return LocationDTO::fromArray($m->toArray());
    }

    /**
     * Delete a location by its primary key ID.
     *
     * @param  int  $id  Primary key ID to delete.
     * @return bool True if record was deleted, false otherwise.
     */
    public function delete(int $id): bool
    {
        // Execute delete statement on location matching ID
        return (bool) Location::query()->where('id', $id)->delete();
    }
}
