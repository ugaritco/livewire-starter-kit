<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\DTOs;

/**
 * Class LocationDTO
 *
 * Immutable DTO representing a physical Location or branch facility.
 */
readonly class LocationDTO
{
    /**
     * Initialize the LocationDTO instance.
     *
     * @param  int  $id  Location primary key identifier.
     * @param  string  $name  Localized name of the location.
     * @param  int|null  $cityId  Optional parent city foreign key.
     * @param  float|null  $latitude  GPS latitude coordinate.
     * @param  float|null  $longitude  GPS longitude coordinate.
     * @param  string|null  $addressLine  Physical street address.
     * @param  string|null  $postalCode  Postal or zip code.
     */
    public function __construct(
        public int $id,
        public string $name,
        public ?int $cityId = null,
        public ?int $districtId = null,
        public ?float $latitude = null,
        public ?float $longitude = null,
        public ?string $addressLine = null,
        public ?string $postalCode = null,
    ) {}

    /**
     * Instantiate a LocationDTO from a raw array.
     *
     * @param  array<string, mixed>  $data  Input attribute array.
     * @return self The constructed LocationDTO instance.
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: (int) ($data['id'] ?? 0),
            name: (string) $data['name'],
            cityId: isset($data['city_id']) ? (int) $data['city_id'] : null,
            districtId: isset($data['district_id']) ? (int) $data['district_id'] : null,
            latitude: isset($data['latitude']) ? (float) $data['latitude'] : null,
            longitude: isset($data['longitude']) ? (float) $data['longitude'] : null,
            addressLine: $data['address_line'] ?? null,
            postalCode: $data['postal_code'] ?? null,
        );
    }

    /**
     * Transform the DTO attributes into a standard array.
     *
     * @return array<string, mixed> Key-value array of location properties.
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
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
