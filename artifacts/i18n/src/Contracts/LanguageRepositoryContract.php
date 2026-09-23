<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\I18n\Contracts;

use Heritage\Support\Collection;
use Ugarit\Artifacts\I18n\DTOs\LanguageDTO;
use Ugarit\Artifacts\I18n\DTOs\SaveLanguageDTO;

/**
 * Interface LanguageRepositoryContract
 *
 * Defines the persistence contract for recognized World Languages.
 */
interface LanguageRepositoryContract
{
    /**
     * Retrieve all recognized languages.
     *
     * @return Collection<int, LanguageDTO> Collection of language DTOs.
     */
    public function all(): Collection;

    /**
     * Find a language by its ISO-639 code.
     *
     * @param  string  $isoCode  Standard ISO code.
     * @return LanguageDTO|null The language DTO if found, null otherwise.
     */
    public function findByIso(string $isoCode): ?LanguageDTO;

    /**
     * Persist or update a language entity.
     *
     * @param  SaveLanguageDTO  $dto  Language persistence DTO.
     * @return LanguageDTO The persisted language DTO instance.
     */
    public function save(SaveLanguageDTO $dto): LanguageDTO;

    /**
     * Delete a language by its primary key ID.
     *
     * @param  int  $id  Primary key ID to delete.
     * @return bool True on success, false otherwise.
     */
    public function delete(int $id): bool;
}
