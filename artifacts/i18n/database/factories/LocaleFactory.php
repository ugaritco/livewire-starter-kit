<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\I18n\Database\Factories;

use Heritage\Database\Eloquent\Factories\Factory;
use Ugarit\Artifacts\I18n\Models\Locale;

/**
 * Class LocaleFactory
 *
 * Eloquent factory for generating Locale configuration records.
 *
 * @extends Factory<Locale>
 */
class LocaleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Locale>
     */
    protected $model = Locale::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $code = fake()->unique()->lexify('??');

        return [
            'code' => $code,
            'name' => fake()->word() . ' Locale',
            'direction' => 'ltr',
            'script' => 'Latn',
            'regional' => $code . '_' . strtoupper($code),
            'is_default' => false,
            'is_active' => true,
        ];
    }

    /**
     * Indicate that the locale is the system default.
     *
     * @return static
     */
    public function default(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_default' => true,
        ]);
    }

    /**
     * Indicate that the locale text direction is right-to-left.
     *
     * @return static
     */
    public function rtl(): static
    {
        return $this->state(fn (array $attributes) => [
            'direction' => 'rtl',
            'script' => 'Arab',
        ]);
    }
}
