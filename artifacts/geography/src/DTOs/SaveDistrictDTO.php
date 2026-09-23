<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\DTOs;

/**
 * Class SaveDistrictDTO
 *
 * Immutable DTO encapsulating payload data for saving a District.
 */
readonly class SaveDistrictDTO
{
    /**
     * Initialize the SaveDistrictDTO instance.
     *
     * @param  int  $cityId  Foreign key referencing parent city.
     * @param  string  $name  District name.
     * @param  int|null  $id  Optional district primary ID for updates.
     * @param  string|null  $code  Administrative code.
     * @param  string|null  $postalCode  Postal or zip code.
     * @param  bool  $isActive  Operational activation flag.
     */
    public function __construct(
        public int $cityId,
        public string $name,
        public ?int $id = null,
        public ?string $code = null,
        public ?string $postalCode = null,
        public bool $isActive = true,
    ) {}

    /**
     * Instantiate a SaveDistrictDTO from a raw array.
     *
     * @param  array<string, mixed>  $data  Input attribute array.
     * @return self The constructed SaveDistrictDTO instance.
     */
    public static function fromArray(array $data): self
    {
        return new self(
            cityId: (int) $data['city_id'],
            name: (string) $data['name'],
            id: isset($data['id']) ? (int) $data['id'] : null,
            code: $data['code'] ?? null,
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
            'city_id' => $this->cityId,
            'name' => $this->name,
            'code' => $this->code,
            'postal_code' => $this->postalCode,
            'is_active' => $this->isActive,
        ];
    }
}
