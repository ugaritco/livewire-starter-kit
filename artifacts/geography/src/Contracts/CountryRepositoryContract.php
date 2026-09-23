<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Contracts;

use Heritage\Support\Collection;
use Ugarit\Artifacts\Geography\DTOs\CountryDTO;
use Ugarit\Artifacts\Geography\DTOs\SaveCountryDTO;

/**
 * Interface CountryRepositoryContract
 *
 * Defines the persistence contract for Country domain entities.
 */
interface CountryRepositoryContract
{
    /**
     * Retrieve all registered countries ordered alphabetically by name.
     *
     * @return Collection<int, CountryDTO> Collection of country DTO instances.
     */
    public function all(): Collection;

    /**
     * Find a single country by its primary key ID.
     *
     * @param  int  $id  Primary key ID of the country.
     * @return CountryDTO|null The country DTO if found, or null otherwise.
     */
    public function findById(int $id): ?CountryDTO;

    /**
     * Find a country by its ISO alpha-2 or alpha-3 code.
     *
     * @param  string  $iso  Two-letter or three-letter ISO code.
     * @return CountryDTO|null The country DTO if found, or null otherwise.
     */
    public function findByIso(string $iso): ?CountryDTO;

    /**
     * Persist or update a country entity from a SaveCountryDTO.
     *
     * @param  SaveCountryDTO  $dto  Country data transfer object.
     * @return CountryDTO The persisted country DTO instance.
     */
    public function save(SaveCountryDTO $dto): CountryDTO;

    /**
     * Delete a country entity by its primary key ID.
     *
     * @param  int  $id  Primary key ID of the country to delete.
     * @return bool True if deletion succeeded, false otherwise.
     */
    public function delete(int $id): bool;
}
