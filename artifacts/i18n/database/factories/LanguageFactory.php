<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\I18n\Database\Factories;

use Heritage\Database\Eloquent\Factories\Factory;
use Ugarit\Artifacts\I18n\Models\Language;

/**
 * Class LanguageFactory
 *
 * Eloquent factory for generating Language ISO registry records.
 *
 * @extends Factory<Language>
 */
class LanguageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Language>
     */
    protected $model = Language::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $code = fake()->unique()->lexify('??');

        return [
            'iso_code' => $code,
            'name' => fake()->word() . ' Language',
            'native_name' => fake()->word(),
            'is_active' => true,
        ];
    }

    /**
     * Indicate that the language is inactive.
     *
     * @return static
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}
