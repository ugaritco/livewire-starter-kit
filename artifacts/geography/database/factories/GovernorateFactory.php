<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Database\Factories;

use Heritage\Database\Eloquent\Factories\Factory;
use Ugarit\Artifacts\Geography\Models\Country;
use Ugarit\Artifacts\Geography\Models\Governorate;

/**
 * Class GovernorateFactory
 *
 * Eloquent factory for generating administrative Governorate/Province models.
 *
 * @extends Factory<Governorate>
 */
class GovernorateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Governorate>
     */
    protected $model = Governorate::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'country_id' => Country::factory(),
            'name' => fake()->city() . ' Province',
            'code' => strtoupper(fake()->lexify('??')),
            'is_active' => true,
        ];
    }

    /**
     * Indicate that the governorate is inactive.
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
