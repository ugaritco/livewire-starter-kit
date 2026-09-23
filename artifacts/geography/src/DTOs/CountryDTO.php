<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\DTOs;

/**
 * Class CountryDTO
 *
 * Immutable Data Transfer Object representing a sovereign Country entity.
 */
readonly class CountryDTO
{
    /**
     * Initialize the CountryDTO instance.
     *
     * @param  int  $id  Country primary key identifier.
     * @param  string  $name  Official localized country name.
     * @param  string  $isoAlpha2  ISO 3166-1 alpha-2 two-letter code.
     * @param  string  $isoAlpha3  ISO 3166-1 alpha-3 three-letter code.
     * @param  string|null  $dialCode  International telephony dialing prefix.
     * @param  string|null  $currencyCode  ISO 4217 standard currency code.
     * @param  string|null  $flagEmoji  Emoji flag representation.
     * @param  bool  $isActive  Operational activation status.
     */
    public function __construct(
        public int $id,
        public string $name,
        public string $isoAlpha2,
        public string $isoAlpha3,
        public ?string $dialCode = null,
        public ?string $currencyCode = null,
        public ?string $flagEmoji = null,
        public bool $isActive = true,
    ) {}

    /**
     * Instantiate a CountryDTO from a raw array.
     *
     * @param  array<string, mixed>  $data  The raw attribute data.
     * @return self The newly constructed CountryDTO instance.
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: (int) ($data['id'] ?? 0),
            name: (string) $data['name'],
            isoAlpha2: (string) $data['iso_alpha_2'],
            isoAlpha3: (string) $data['iso_alpha_3'],
            dialCode: $data['dial_code'] ?? null,
            currencyCode: $data['currency_code'] ?? null,
            flagEmoji: $data['flag_emoji'] ?? null,
            isActive: (bool) ($data['is_active'] ?? true),
        );
    }

    /**
     * Transform the DTO attributes into a standard array.
     *
     * @return array<string, mixed> Key-value array of country properties.
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
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
