<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\DTOs;

/**
 * Class SaveGovernorateDTO
 *
 * Immutable DTO encapsulating payload data for saving a Governorate.
 */
readonly class SaveGovernorateDTO
{
    /**
     * Initialize the SaveGovernorateDTO instance.
     *
     * @param  int  $countryId  Foreign key referencing parent country.
     * @param  string  $name  Governorate name.
     * @param  int|null  $id  Optional governorate primary ID for updates.
     * @param  string|null  $code  Administrative code.
     * @param  bool  $isActive  Operational activation status.
     */
    public function __construct(
        public int $countryId,
        public string $name,
        public ?int $id = null,
        public ?string $code = null,
        public bool $isActive = true,
    ) {}

    /**
     * Instantiate a SaveGovernorateDTO from a raw array.
     *
     * @param  array<string, mixed>  $data  Input attribute array.
     * @return self The constructed SaveGovernorateDTO instance.
     */
    public static function fromArray(array $data): self
    {
        return new self(
            countryId: (int) $data['country_id'],
            name: (string) $data['name'],
            id: isset($data['id']) ? (int) $data['id'] : null,
            code: $data['code'] ?? null,
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
            'country_id' => $this->countryId,
            'name' => $this->name,
            'code' => $this->code,
            'is_active' => $this->isActive,
        ];
    }
}
