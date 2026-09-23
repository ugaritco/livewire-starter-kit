<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Repositories;

use Heritage\Support\Collection;
use Ugarit\Artifacts\Geography\Contracts\DistrictRepositoryContract;
use Ugarit\Artifacts\Geography\DTOs\DistrictDTO;
use Ugarit\Artifacts\Geography\DTOs\SaveDistrictDTO;
use Ugarit\Artifacts\Geography\Models\District;

/**
 * Class DistrictRepository
 *
 * Eloquent implementation of the DistrictRepositoryContract.
 */
class DistrictRepository implements DistrictRepositoryContract
{
    /**
     * Retrieve all districts, optionally filtered by a parent city ID.
     *
     * @param  int|null  $cityId  Optional city ID filter.
     * @return Collection<int, DistrictDTO> Collection of district DTOs.
     */
    public function all(?int $cityId = null): Collection
    {
        $query = District::query();

        // Apply city filter if provided
        if ($cityId !== null) {
            $query->where('city_id', $cityId);
        }

        // Fetch ordered districts and map to DTO collection
        return $query->orderBy('name', 'asc')
            ->get()
            ->map(fn (District $m) => DistrictDTO::fromArray($m->toArray()));
    }

    /**
     * Find a district by its primary key ID.
     *
     * @param  int  $id  District primary key ID.
     * @return DistrictDTO|null The district DTO if found, or null otherwise.
     */
    public function findById(int $id): ?DistrictDTO
    {
        // Query district by primary key ID
        $m = District::query()->find($id);

        return $m ? DistrictDTO::fromArray($m->toArray()) : null;
    }

    /**
     * Persist or update a district entity.
     *
     * @param  SaveDistrictDTO  $dto  District persistence data.
     * @return DistrictDTO The persisted district DTO instance.
     */
    public function save(SaveDistrictDTO $dto): DistrictDTO
    {
        // Locate existing district model or create a fresh instance
        $m = $dto->id ? District::query()->findOrFail($dto->id) : new District();

        // Fill attributes from DTO and persist
        $m->fill($dto->toPersistenceArray());
        $m->save();

        // Return mapped DTO representation
        return DistrictDTO::fromArray($m->toArray());
    }

    /**
     * Delete a district by its primary key ID.
     *
     * @param  int  $id  Primary key ID to delete.
     * @return bool True if record was deleted, false otherwise.
     */
    public function delete(int $id): bool
    {
        // Execute delete statement on district matching ID
        return (bool) District::query()->where('id', $id)->delete();
    }
}
