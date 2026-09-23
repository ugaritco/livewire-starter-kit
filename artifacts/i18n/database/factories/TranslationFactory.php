<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\I18n\Database\Factories;

use Heritage\Database\Eloquent\Factories\Factory;
use Ugarit\Artifacts\I18n\Models\Translation;

/**
 * Class TranslationFactory
 *
 * Eloquent factory for generating polymorphic model Translation records.
 *
 * @extends Factory<Translation>
 */
class TranslationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Translation>
     */
    protected $model = Translation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'translatable_type' => 'App\\Models\\Sample',
            'translatable_id' => fake()->randomNumber(4),
            'locale' => 'en',
            'key' => fake()->word(),
            'value' => fake()->sentence(),
        ];
    }
}
