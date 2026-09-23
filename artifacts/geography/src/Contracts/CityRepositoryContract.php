<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Contracts;

use Heritage\Support\Collection;
use Ugarit\Artifacts\Geography\DTOs\CityDTO;
use Ugarit\Artifacts\Geography\DTOs\SaveCityDTO;

/**
 * Interface CityRepositoryContract
 *
 * Defines the persistence contract for City/Municipality domain entities.
 */
interface CityRepositoryContract
{
    /**
     * Retrieve all cities, optionally filtered by parent governorate ID.
     *
     * @param  int|null  $governorateId  Optional parent governorate ID.
     * @return Collection<int, CityDTO> Collection of city DTO instances.
     */
    public function all(?int $governorateId = null): Collection;

    /**
     * Find a specific city by its primary key ID.
     *
     * @param  int  $id  City primary key ID.
     * @return CityDTO|null The city DTO if found, null otherwise.
     */
    public function findById(int $id): ?CityDTO;

    /**
     * Persist or update a city entity.
     *
     * @param  SaveCityDTO  $dto  City data transfer object.
     * @return CityDTO The persisted city DTO instance.
     */
    public function save(SaveCityDTO $dto): CityDTO;

    /**
     * Delete a city entity by its primary key ID.
     *
     * @param  int  $id  City primary key ID to delete.
     * @return bool True on success, false otherwise.
     */
    public function delete(int $id): bool;
}
