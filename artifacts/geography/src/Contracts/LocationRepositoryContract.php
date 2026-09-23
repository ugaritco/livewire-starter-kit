<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Contracts;

use Heritage\Support\Collection;
use Ugarit\Artifacts\Geography\DTOs\LocationDTO;
use Ugarit\Artifacts\Geography\DTOs\SaveLocationDTO;

/**
 * Interface LocationRepositoryContract
 *
 * Defines the persistence contract for geographical Location / Address entities.
 */
interface LocationRepositoryContract
{
    /**
     * Retrieve all physical locations, optionally filtered by parent city ID.
     *
     * @param  int|null  $cityId  Optional parent city ID.
     * @return Collection<int, LocationDTO> Collection of location DTOs.
     */
    public function all(?int $cityId = null): Collection;

    /**
     * Find a specific location by its primary key ID.
     *
     * @param  int  $id  Location primary key ID.
     * @return LocationDTO|null The location DTO if found, null otherwise.
     */
    public function findById(int $id): ?LocationDTO;

    /**
     * Persist or update a geographical location entity.
     *
     * @param  SaveLocationDTO  $dto  Location data transfer object.
     * @return LocationDTO The persisted location DTO instance.
     */
    public function save(SaveLocationDTO $dto): LocationDTO;

    /**
     * Delete a location entity by its primary key ID.
     *
     * @param  int  $id  Location primary key ID to delete.
     * @return bool True on success, false otherwise.
     */
    public function delete(int $id): bool;
}
