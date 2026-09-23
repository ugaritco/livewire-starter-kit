<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\I18n\DTOs;

/**
 * Class LanguageDTO
 *
 * Immutable DTO representing a recognized World Language.
 */
readonly class LanguageDTO
{
    /**
     * Initialize the LanguageDTO instance.
     *
     * @param  int  $id  Language primary key identifier.
     * @param  string  $isoCode  Standard ISO-639 code.
     * @param  string  $name  International name.
     * @param  string  $nativeName  Native language denomination.
     * @param  bool  $isActive  Operational activation flag.
     */
    public function __construct(
        public int $id,
        public string $isoCode,
        public string $name,
        public string $nativeName,
        public bool $isActive = true,
    ) {}

    /**
     * Instantiate a LanguageDTO from a raw array.
     *
     * @param  array<string, mixed>  $data  Input attribute array.
     * @return self The constructed LanguageDTO instance.
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: (int) ($data['id'] ?? 0),
            isoCode: (string) $data['iso_code'],
            name: (string) $data['name'],
            nativeName: (string) $data['native_name'],
            isActive: (bool) ($data['is_active'] ?? true),
        );
    }

    /**
     * Transform the DTO attributes into a standard array.
     *
     * @return array<string, mixed> Key-value array of language properties.
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'iso_code' => $this->isoCode,
            'name' => $this->name,
            'native_name' => $this->nativeName,
            'is_active' => $this->isActive,
        ];
    }
}
