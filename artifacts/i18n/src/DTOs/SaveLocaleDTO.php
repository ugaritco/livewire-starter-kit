<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\I18n\DTOs;

use Ugarit\Artifacts\I18n\Enums\TextDirection;

/**
 * Class SaveLocaleDTO
 *
 * Immutable DTO encapsulating payload data for saving a Locale.
 */
readonly class SaveLocaleDTO
{
    /**
     * Initialize the SaveLocaleDTO instance.
     *
     * @param  string  $code  Locale code.
     * @param  string  $name  Locale name.
     * @param  TextDirection  $direction  Text direction.
     * @param  string|null  $script  Writing script.
     * @param  string|null  $regional  Regional dialect code.
     * @param  bool  $isDefault  Default indicator.
     * @param  bool  $isActive  Activation status.
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
     * Instantiate a SaveLocaleDTO from a raw array.
     *
     * @param  array<string, mixed>  $data  Input attribute array.
     * @return self The constructed SaveLocaleDTO instance.
     */
    public static function fromArray(array $data): self
    {
        return new self(
            code: strtolower(trim((string) $data['code'])),
            name: (string) $data['name'],
            direction: TextDirection::tryFrom($data['direction'] ?? '') ?? TextDirection::LTR,
            script: $data['script'] ?? null,
            regional: $data['regional'] ?? null,
            isDefault: (bool) ($data['is_default'] ?? false),
            isActive: (bool) ($data['is_active'] ?? true),
        );
    }

    /**
     * Transform the DTO into a persistence array.
     *
     * @return array<string, mixed> Database-ready attribute array.
     */
    public function toPersistenceArray(): array
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
