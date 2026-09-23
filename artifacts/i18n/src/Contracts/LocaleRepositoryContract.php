<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\I18n\Contracts;

use Heritage\Support\Collection;
use Ugarit\Artifacts\I18n\DTOs\LocaleDTO;
use Ugarit\Artifacts\I18n\DTOs\SaveLocaleDTO;

/**
 * Interface LocaleRepositoryContract
 *
 * Defines the persistence contract for system Locale configurations.
 */
interface LocaleRepositoryContract
{
    /**
     * Retrieve all active locales.
     *
     * @return Collection<int, LocaleDTO> Collection of locale DTOs.
     */
    public function all(): Collection;

    /**
     * Find a specific locale by its code (e.g. 'ar', 'en').
     *
     * @param  string  $code  Standard locale code.
     * @return LocaleDTO|null The locale DTO if found, null otherwise.
     */
    public function findByCode(string $code): ?LocaleDTO;

    /**
     * Retrieve the system default locale.
     *
     * @return LocaleDTO|null The default locale DTO.
     */
    public function getDefault(): ?LocaleDTO;

    /**
     * Persist or update a locale entity.
     *
     * @param  SaveLocaleDTO  $dto  Locale persistence DTO.
     * @return LocaleDTO The persisted locale DTO instance.
     */
    public function save(SaveLocaleDTO $dto): LocaleDTO;

    /**
     * Delete a locale by its code.
     *
     * @param  string  $code  Locale code to remove.
     * @return bool True on success, false otherwise.
     */
    public function delete(string $code): bool;
}
