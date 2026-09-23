<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Database\Factories;

use Heritage\Database\Eloquent\Factories\Factory;
use Ugarit\Artifacts\Geography\Models\Country;

/**
 * Class CountryFactory
 *
 * Eloquent factory for manufacturing Country model instances with realistic spatial and regional attributes.
 *
 * @extends Factory<Country>
 */
class CountryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Country>
     */
    protected $model = Country::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Generate random unique ISO alpha-2 and alpha-3 codes
        $alpha2 = strtoupper(fake()->unique()->lexify('??'));
        $alpha3 = strtoupper($alpha2 . fake()->lexify('?'));

        return [
            'name' => fake()->country(),
            'iso_alpha_2' => $alpha2,
            'iso_alpha_3' => $alpha3,
            'dial_code' => '+' . fake()->numberBetween(1, 999),
            'currency_code' => strtoupper(fake()->lexify('???')),
            'flag_emoji' => '🌐',
            'is_active' => true,
        ];
    }

    /**
     * Indicate that the country is inactive.
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
