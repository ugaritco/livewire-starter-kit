<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\I18n\DTOs;

use Ugarit\Artifacts\I18n\Enums\TextDirection;

/**
 * Class LocaleDTO
 *
 * Immutable DTO representing a Locale configuration.
 */
readonly class LocaleDTO
{
    /**
     * Initialize the LocaleDTO instance.
     *
     * @param  string  $code  Standard locale code.
     * @param  string  $name  Localized name.
     * @param  TextDirection  $direction  Text directionality.
     * @param  string|null  $script  Writing script.
     * @param  string|null  $regional  Regional dialect code.
     * @param  bool  $isDefault  Default locale indicator.
     * @param  bool  $isActive  Operational activation flag.
     */
    public function __construct(
        public string $code,
        public string $name,
        public TextDirection $direction = TextDirection::LTR,
        public ?string $script = null,
        public ?string $regional = null,
        public bool $isDefault = false,
        public bool $isActive = true,
    ) {}

    /**
     * Instantiate a LocaleDTO from a raw array.
     *
     * @param  array<string, mixed>  $data  Input attribute array.
     * @return self The constructed LocaleDTO instance.
     */
    public static function fromArray(array $data): self
    {
        return new self(
            code: (string) $data['code'],
            name: (string) $data['name'],
            direction: TextDirection::tryFrom($data['direction'] ?? '') ?? TextDirection::LTR,
            script: $data['script'] ?? null,
            regional: $data['regional'] ?? null,
            isDefault: (bool) ($data['is_default'] ?? false),
            isActive: (bool) ($data['is_active'] ?? true),
        );
    }

    /**
     * Transform the DTO attributes into a standard array.
     *
     * @return array<string, mixed> Key-value array of locale properties.
     */
    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'name' => $this->name,
            'direction' => $this->direction->value,
            'script' => $this->script,
            'regional' => $this->regional,
            'is_default' => $this->isDefault,
            'is_active' => $this->isActive,
        ];
    }
}
