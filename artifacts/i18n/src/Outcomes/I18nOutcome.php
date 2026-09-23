<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\I18n\Outcomes;

/**
 * Class I18nOutcome
 *
 * Execution outcome envelope for I18n domain operations.
 */
readonly class I18nOutcome
{
    /**
     * Initialize the I18nOutcome instance.
     *
     * @param  bool  $successful  Success status flag.
     * @param  mixed  $data  Payload data.
     * @param  string|null  $message  Optional message.
     * @param  array<string, mixed>  $errors  Error collection.
     * @param  array<string, mixed>  $actions  Client actions.
     */
    public function __construct(
        public bool $successful,
        public mixed $data = null,
        public ?string $message = null,
        public array $errors = [],
        public array $actions = [],
    ) {}

    /**
     * Create a successful outcome instance.
     *
     * @param  mixed  $data  Resulting data payload.
     * @param  string|null  $message  Success message.
     * @param  array<string, mixed>  $actions  Client actions.
     * @return self New successful outcome instance.
     */
    public static function success(mixed $data = null, ?string $message = null, array $actions = []): self
    {
        return new self(
            successful: true,
            data: $data,
            message: $message,
            actions: $actions
        );
    }

    /**
     * Create a failure outcome instance.
     *
     * @param  string  $message  Failure explanation message.
     * @param  array<string, mixed>  $errors  Error collection.
     * @return self New failure outcome instance.
     */
    public static function failure(string $message, array $errors = []): self
    {
        return new self(
            successful: false,
            message: $message,
            errors: $errors
        );
    }

    /**
     * Transform the outcome into an associative array.
     *
     * @return array<string, mixed> Formatted output array.
     */
    public function toArray(): array
    {
        return [
            'success' => $this->successful,
            'data' => $this->data,
            'message' => $this->message,
            'errors' => $this->errors,
            'actions' => $this->actions,
        ];
    }
}
