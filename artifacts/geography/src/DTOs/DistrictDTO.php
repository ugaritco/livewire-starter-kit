<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\DTOs;

/**
 * Class DistrictDTO
 *
 * Immutable DTO representing an administrative District / Neighborhood entity.
 */
readonly class DistrictDTO
{
    /**
     * Initialize the DistrictDTO instance.
     *
     * @param  int  $id  District primary key identifier.
     * @param  int  $cityId  Foreign key referencing parent city.
     * @param  string  $name  Localized name of the district.
     * @param  string|null  $code  Optional administrative code.
     * @param  string|null  $postalCode  Postal or zip code.
     * @param  bool  $isActive  Operational activation flag.
     */
    public function __construct(
        public int $id,
        public int $cityId,
        public string $name,
        public ?string $code = null,
        public ?string $postalCode = null,
        public bool $isActive = true,
    ) {}

    /**
     * Instantiate a DistrictDTO from a raw array.
     *
     * @param  array<string, mixed>  $data  Input attribute array.
     * @return self The constructed DistrictDTO instance.
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: (int) ($data['id'] ?? 0),
            cityId: (int) $data['city_id'],
            name: (string) $data['name'],
            code: $data['code'] ?? null,
            postalCode: $data['postal_code'] ?? null,
            isActive: (bool) ($data['is_active'] ?? true),
        );
    }

    /**
     * Transform the DTO attributes into a standard array.
     *
     * @return array<string, mixed> Key-value array of district properties.
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'city_id' => $this->cityId,
            'name' => $this->name,
            'code' => $this->code,
            'postal_code' => $this->postalCode,
            'is_active' => $this->isActive,
        ];
    }
}
