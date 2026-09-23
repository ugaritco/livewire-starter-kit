<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\DTOs;

/**
 * Class SaveLocationDTO
 *
 * Immutable DTO encapsulating payload data for saving a Location.
 */
readonly class SaveLocationDTO
{
    /**
     * Initialize the SaveLocationDTO instance.
     *
     * @param  string  $name  Location name.
     * @param  int|null  $id  Optional location primary ID for updates.
     * @param  int|null  $cityId  Optional parent city foreign key.
     * @param  float|null  $latitude  GPS latitude coordinate.
     * @param  float|null  $longitude  GPS longitude coordinate.
     * @param  string|null  $addressLine  Physical street address.
     * @param  string|null  $postalCode  Postal code.
     */
    public function __construct(
        public string $name,
        public ?int $id = null,
        public ?int $cityId = null,
        public ?int $districtId = null,
        public ?float $latitude = null,
        public ?float $longitude = null,
        public ?string $addressLine = null,
        public ?string $postalCode = null,
    ) {}

    /**
     * Instantiate a SaveLocationDTO from a raw array.
     *
     * @param  array<string, mixed>  $data  Input attribute array.
     * @return self The constructed SaveLocationDTO instance.
     */
    public static function fromArray(array $data): self
    {
        return new self(
            name: (string) $data['name'],
            id: isset($data['id']) ? (int) $data['id'] : null,
            cityId: isset($data['city_id']) ? (int) $data['city_id'] : null,
            districtId: isset($data['district_id']) ? (int) $data['district_id'] : null,
            latitude: isset($data['latitude']) ? (float) $data['latitude'] : null,
            longitude: isset($data['longitude']) ? (float) $data['longitude'] : null,
            addressLine: $data['address_line'] ?? null,
            postalCode: $data['postal_code'] ?? null,
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
            'name' => $this->name,
            'city_id' => $this->cityId,
            'district_id' => $this->districtId,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'address_line' => $this->addressLine,
            'postal_code' => $this->postalCode,
        ];
    }
}
