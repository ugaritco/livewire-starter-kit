<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\DTOs;

/**
 * Class SaveCityDTO
 *
 * Immutable DTO encapsulating payload data for saving a City.
 */
readonly class SaveCityDTO
{
    /**
     * Initialize the SaveCityDTO instance.
     *
     * @param  int  $governorateId  Foreign key referencing parent governorate.
     * @param  string  $name  City name.
     * @param  int|null  $id  Optional city primary ID for updates.
     * @param  string|null  $postalCode  Postal or zip code.
     * @param  bool  $isActive  Operational activation status.
     */
    public function __construct(
        public int $governorateId,
        public string $name,
        public ?int $id = null,
        public ?string $postalCode = null,
        public bool $isActive = true,
    ) {}

    /**
     * Instantiate a SaveCityDTO from a raw array.
     *
     * @param  array<string, mixed>  $data  Input attribute array.
     * @return self The constructed SaveCityDTO instance.
     */
    public static function fromArray(array $data): self
    {
        return new self(
            governorateId: (int) $data['governorate_id'],
            name: (string) $data['name'],
            id: isset($data['id']) ? (int) $data['id'] : null,
            postalCode: $data['postal_code'] ?? null,
            isActive: (bool) ($data['is_active'] ?? true),
        );
    }

    /**
     * Transform the DTO into a database persistence array.
     *
     * @return array<string, mixed> Database-ready attribute array.
     */
    public function toPersistenceArray(): array
    {
        return [
            'governorate_id' => $this->governorateId,
            'name' => $this->name,
            'postal_code' => $this->postalCode,
            'is_active' => $this->isActive,
        ];
    }
}
