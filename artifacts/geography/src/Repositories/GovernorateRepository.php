<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Repositories;

use Heritage\Support\Collection;
use Ugarit\Artifacts\Geography\Contracts\GovernorateRepositoryContract;
use Ugarit\Artifacts\Geography\DTOs\GovernorateDTO;
use Ugarit\Artifacts\Geography\DTOs\SaveGovernorateDTO;
use Ugarit\Artifacts\Geography\Models\Governorate;

/**
 * Class GovernorateRepository
 *
 * Eloquent implementation of the GovernorateRepositoryContract.
 */
class GovernorateRepository implements GovernorateRepositoryContract
{
    /**
     * Retrieve all governorates, optionally filtered by a parent country ID.
     *
     * @param  int|null  $countryId  Optional country ID filter.
     * @return Collection<int, GovernorateDTO> Collection of governorate DTOs.
     */
    public function all(?int $countryId = null): Collection
    {
        $query = Governorate::query();

        // Apply country filter if specified
        if ($countryId !== null) {
            $query->where('country_id', $countryId);
        }

        // Fetch ordered governorates and transform to DTO collection
        return $query->orderBy('name', 'asc')
            ->get()
            ->map(fn (Governorate $m) => GovernorateDTO::fromArray($m->toArray()));
    }

    /**
     * Find a governorate by its primary key ID.
     *
     * @param  int  $id  Governorate primary key ID.
     * @return GovernorateDTO|null The governorate DTO if found, or null otherwise.
     */
    public function findById(int $id): ?GovernorateDTO
    {
        // Query governorate by primary key ID
        $m = Governorate::query()->find($id);

        return $m ? GovernorateDTO::fromArray($m->toArray()) : null;
    }

    /**
     * Persist or update a governorate entity.
     *
     * @param  SaveGovernorateDTO  $dto  Governorate persistence data.
     * @return GovernorateDTO The persisted governorate DTO instance.
     */
    public function save(SaveGovernorateDTO $dto): GovernorateDTO
    {
        // Find existing governorate model or instantiate a fresh instance
        $m = $dto->id ? Governorate::query()->findOrFail($dto->id) : new Governorate();

        // Fill attributes from DTO and persist
        $m->fill($dto->toPersistenceArray());
        $m->save();

        // Return mapped DTO representation
        return GovernorateDTO::fromArray($m->toArray());
    }

    /**
     * Delete a governorate by its primary key ID.
     *
     * @param  int  $id  Primary key ID to delete.
     * @return bool True if record was deleted, false otherwise.
     */
    public function delete(int $id): bool
    {
        // Execute delete statement on governorate matching ID
        return (bool) Governorate::query()->where('id', $id)->delete();
    }
}
