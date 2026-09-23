<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Database\Factories;

use Heritage\Database\Eloquent\Factories\Factory;
use Ugarit\Artifacts\Geography\Models\City;
use Ugarit\Artifacts\Geography\Models\Governorate;

/**
 * Class CityFactory
 *
 * Eloquent factory for generating City models linked to parent governorates.
 *
 * @extends Factory<City>
 */
class CityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<City>
     */
    protected $model = City::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'governorate_id' => Governorate::factory(),
            'name' => fake()->city(),
            'postal_code' => fake()->postcode(),
            'is_active' => true,
        ];
    }

    /**
     * Indicate that the city is inactive.
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
