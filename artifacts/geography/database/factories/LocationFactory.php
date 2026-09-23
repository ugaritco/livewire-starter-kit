<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Database\Factories;

use Heritage\Database\Eloquent\Factories\Factory;
use Ugarit\Artifacts\Geography\Models\City;
use Ugarit\Artifacts\Geography\Models\District;
use Ugarit\Artifacts\Geography\Models\Location;

/**
 * Class LocationFactory
 *
 * Eloquent factory for generating physical Location landmarks with spatial coordinates.
 *
 * @extends Factory<Location>
 */
class LocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Location>
     */
    protected $model = Location::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'city_id' => City::factory(),
            'district_id' => District::factory(),
            'name' => fake()->company() . ' Center',
            'latitude' => fake()->latitude(20.0, 30.0),
            'longitude' => fake()->longitude(35.0, 50.0),
            'address_line' => fake()->streetAddress(),
            'postal_code' => fake()->postcode(),
        ];
    }
}
