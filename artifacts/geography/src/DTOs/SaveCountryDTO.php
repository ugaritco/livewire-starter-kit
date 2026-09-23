<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\DTOs;

/**
 * Class SaveCountryDTO
 *
 * Immutable DTO encapsulating payload data for creating or updating a Country.
 */
readonly class SaveCountryDTO
{
    /**
     * Initialize the SaveCountryDTO instance.
     *
     * @param  string  $name  Country name.
     * @param  string  $isoAlpha2  ISO 3166-1 alpha-2 code.
     * @param  string  $isoAlpha3  ISO 3166-1 alpha-3 code.
     * @param  int|null  $id  Optional country primary ID for update operations.
     * @param  string|null  $dialCode  International telephony dial code.
     * @param  string|null  $currencyCode  ISO currency code.
     * @param  string|null  $flagEmoji  Emoji flag representation.
     * @param  bool  $isActive  Operational activation status.
     */
    public function __construct(
        public string $name,
        public string $isoAlpha2,
        public string $isoAlpha3,
        public ?int $id = null,
        public ?string $dialCode = null,
        public ?string $currencyCode = null,
        public ?string $flagEmoji = null,
        public bool $isActive = true,
    ) {}

    /**
     * Instantiate a SaveCountryDTO from a raw array.
     *
     * @param  array<string, mixed>  $data  Input payload array.
     * @return self The constructed SaveCountryDTO instance.
     */
    public static function fromArray(array $data): self
    {
        return new self(
            name: (string) $data['name'],
            isoAlpha2: strtoupper((string) $data['iso_alpha_2']),
            isoAlpha3: strtoupper((string) $data['iso_alpha_3']),
            id: isset($data['id']) ? (int) $data['id'] : null,
            dialCode: $data['dial_code'] ?? null,
            currencyCode: isset($data['currency_code']) ? strtoupper((string) $data['currency_code']) : null,
            flagEmoji: $data['flag_emoji'] ?? null,
            isActive: (bool) ($data['is_active'] ?? true),
        );
    }

    /**
     * Transform the DTO into an array formatted for database model persistence.
     *
     * @return array<string, mixed> Database-ready attribute array.
     */
    public function toPersistenceArray(): array
    {
        return [
            'name' => $this->name,
            'iso_alpha_2' => $this->isoAlpha2,
            'iso_alpha_3' => $this->isoAlpha3,
            'dial_code' => $this->dialCode,
            'currency_code' => $this->currencyCode,
            'flag_emoji' => $this->flagEmoji,
            'is_active' => $this->isActive,
        ];
    }
}
