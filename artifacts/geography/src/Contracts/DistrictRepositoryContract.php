<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Contracts;

use Heritage\Support\Collection;
use Ugarit\Artifacts\Geography\DTOs\DistrictDTO;
use Ugarit\Artifacts\Geography\DTOs\SaveDistrictDTO;

/**
 * Interface DistrictRepositoryContract
 *
 * Defines the persistence contract for District / Neighborhood domain entities.
 */
interface DistrictRepositoryContract
{
    /**
     * Retrieve all districts, optionally filtered by a parent city ID.
     *
     * @param  int|null  $cityId  Optional parent city ID.
     * @return Collection<int, DistrictDTO> Collection of district DTOs.
     */
    public function all(?int $cityId = null): Collection;

    /**
     * Find a specific district by its primary key ID.
     *
     * @param  int  $id  District primary key ID.
     * @return DistrictDTO|null The district DTO if found, null otherwise.
     */
    public function findById(int $id): ?DistrictDTO;

    /**
     * Persist or update a district entity.
     *
     * @param  SaveDistrictDTO  $dto  District data transfer object.
     * @return DistrictDTO The persisted district DTO instance.
     */
    public function save(SaveDistrictDTO $dto): DistrictDTO;

    /**
     * Delete a district entity by its primary key ID.
     *
     * @param  int  $id  District primary key ID to delete.
     * @return bool True on success, false otherwise.
     */
    public function delete(int $id): bool;
}
