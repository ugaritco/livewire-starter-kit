<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\DTOs;

/**
 * Class GovernorateDTO
 *
 * Immutable DTO representing an administrative Governorate / Province.
 */
readonly class GovernorateDTO
{
    /**
     * Initialize the GovernorateDTO instance.
     *
     * @param  int  $id  Governorate primary key identifier.
     * @param  int  $countryId  Foreign key referencing parent country.
     * @param  string  $name  Localized name of the governorate.
     * @param  string|null  $code  Administrative region code.
     * @param  bool  $isActive  Operational activation status.
     */
    public function __construct(
        public int $id,
        public int $countryId,
        public string $name,
        public ?string $code = null,
        public bool $isActive = true,
    ) {}

    /**
     * Instantiate a GovernorateDTO from a raw array.
     *
     * @param  array<string, mixed>  $data  Input attribute array.
     * @return self The constructed GovernorateDTO instance.
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: (int) ($data['id'] ?? 0),
            countryId: (int) $data['country_id'],
            name: (string) $data['name'],
            code: $data['code'] ?? null,
            isActive: (bool) ($data['is_active'] ?? true),
        );
    }

    /**
     * Transform the DTO attributes into a standard array.
     *
     * @return array<string, mixed> Array representation of governorate data.
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'country_id' => $this->countryId,
            'name' => $this->name,
            'code' => $this->code,
            'is_active' => $this->isActive,
        ];
    }
}
