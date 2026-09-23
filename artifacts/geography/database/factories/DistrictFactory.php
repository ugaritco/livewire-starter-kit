<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Database\Factories;

use Heritage\Database\Eloquent\Factories\Factory;
use Ugarit\Artifacts\Geography\Models\City;
use Ugarit\Artifacts\Geography\Models\District;

/**
 * Class DistrictFactory
 *
 * Eloquent factory for generating District models linked to parent cities.
 *
 * @extends Factory<District>
 */
class DistrictFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<District>
     */
    protected $model = District::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'city_id' => City::factory(),
            'name' => fake()->streetName() . ' District',
            'code' => strtoupper(fake()->lexify('DIST-???')),
            'postal_code' => fake()->postcode(),
            'is_active' => true,
        ];
    }

    /**
     * Indicate that the district is inactive.
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
