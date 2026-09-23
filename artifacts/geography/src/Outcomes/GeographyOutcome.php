<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Outcomes;

/**
 * Class GeographyOutcome
 *
 * Execution outcome envelope for Geography domain operations.
 */
readonly class GeographyOutcome
{
    /**
     * Initialize the GeographyOutcome instance.
     *
     * @param  bool  $successful  Success status flag.
     * @param  mixed  $data  Payload data.
     * @param  string|null  $message  Optional response message.
     * @param  array<string, mixed>  $errors  Array of validation or runtime errors.
     * @param  array<string, mixed>  $actions  Dispatched or recommended client actions.
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
     * @param  array<string, mixed>  $errors  Detailed error collection.
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
     * Transform the outcome into a standardized associative array.
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
