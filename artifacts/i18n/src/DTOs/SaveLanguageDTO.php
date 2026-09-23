<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\I18n\DTOs;

/**
 * Class SaveLanguageDTO
 *
 * Immutable DTO encapsulating payload data for saving a Language.
 */
readonly class SaveLanguageDTO
{
    /**
     * Initialize the SaveLanguageDTO instance.
     *
     * @param  string  $isoCode  ISO language code.
     * @param  string  $name  International name.
     * @param  string  $nativeName  Native name.
     * @param  int|null  $id  Optional primary ID for updates.
     * @param  bool  $isActive  Activation status.
     */
    public function __construct(
        public string $isoCode,
        public string $name,
        public string $nativeName,
        public ?int $id = null,
        public bool $isActive = true,
    ) {}

    /**
     * Instantiate a SaveLanguageDTO from a raw array.
     *
     * @param  array<string, mixed>  $data  Input attribute array.
     * @return self The constructed SaveLanguageDTO instance.
     */
    public static function fromArray(array $data): self
    {
        return new self(
            isoCode: strtolower(trim((string) $data['iso_code'])),
            name: (string) $data['name'],
            nativeName: (string) $data['native_name'],
            id: isset($data['id']) ? (int) $data['id'] : null,
            isActive: (bool) ($data['is_active'] ?? true),
        );
    }

    /**
     * Transform the DTO into a persistence array.
     *
     * @return array<string, mixed> Database-ready attribute array.
     */
    public function toPersistenceArray(): array
    {
        return [
            'iso_code' => $this->isoCode,
            'name' => $this->name,
            'native_name' => $this->nativeName,
            'is_active' => $this->isActive,
        ];
    }
}
