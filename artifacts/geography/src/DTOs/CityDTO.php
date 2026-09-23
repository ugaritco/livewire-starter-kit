<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\DTOs;

/**
 * Class CityDTO
 *
 * Immutable DTO representing an administrative City entity.
 */
readonly class CityDTO
{
    /**
     * Initialize the CityDTO instance.
     *
     * @param  int  $id  City primary key identifier.
     * @param  int  $governorateId  Foreign key referencing parent governorate.
     * @param  string  $name  Localized name of the city.
     * @param  string|null  $postalCode  Official postal or zip code.
     * @param  bool  $isActive  Operational activation status.
     */
    public function __construct(
        public int $id,
        public int $governorateId,
        public string $name,
        public ?string $postalCode = null,
        public bool $isActive = true,
    ) {}

    /**
     * Instantiate a CityDTO from a raw array.
     *
     * @param  array<string, mixed>  $data  Raw input data array.
     * @return self The constructed CityDTO instance.
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: (int) ($data['id'] ?? 0),
            governorateId: (int) $data['governorate_id'],
            name: (string) $data['name'],
            postalCode: $data['postal_code'] ?? null,
            isActive: (bool) ($data['is_active'] ?? true),
        );
    }

    /**
     * Transform the DTO attributes into a standard array.
     *
     * @return array<string, mixed> Key-value array of city properties.
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'governorate_id' => $this->governorateId,
            'name' => $this->name,
            'postal_code' => $this->postalCode,
            'is_active' => $this->isActive,
        ];
    }
}
