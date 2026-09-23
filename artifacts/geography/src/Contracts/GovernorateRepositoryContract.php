<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Contracts;

use Heritage\Support\Collection;
use Ugarit\Artifacts\Geography\DTOs\GovernorateDTO;
use Ugarit\Artifacts\Geography\DTOs\SaveGovernorateDTO;

/**
 * Interface GovernorateRepositoryContract
 *
 * Defines the persistence contract for administrative Governorate entities.
 */
interface GovernorateRepositoryContract
{
    /**
     * Retrieve all governorates, optionally filtered by a parent country ID.
     *
     * @param  int|null  $countryId  Optional parent country filter.
     * @return Collection<int, GovernorateDTO> Collection of governorate DTOs.
     */
    public function all(?int $countryId = null): Collection;

    /**
     * Find a specific governorate by its primary key ID.
     *
     * @param  int  $id  Governorate primary key ID.
     * @return GovernorateDTO|null The governorate DTO if found, null otherwise.
     */
    public function findById(int $id): ?GovernorateDTO;

    /**
     * Persist or update a governorate entity.
     *
     * @param  SaveGovernorateDTO  $dto  Governorate data transfer object.
     * @return GovernorateDTO The persisted governorate DTO instance.
     */
    public function save(SaveGovernorateDTO $dto): GovernorateDTO;

    /**
     * Delete a governorate entity by its primary key ID.
     *
     * @param  int  $id  Governorate primary key ID to delete.
     * @return bool True on success, false otherwise.
     */
    public function delete(int $id): bool;
}
