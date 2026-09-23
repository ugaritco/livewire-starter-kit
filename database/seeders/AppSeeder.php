<?php

declare(strict_types=1);

namespace Database\Seeders;

use Heritage\Database\Seeder;
use Ugarit\Artifacts\Geography\Database\Seeders\GeographyDatabaseSeeder;
use Ugarit\Artifacts\I18n\Database\Seeders\I18nDatabaseSeeder;

/**
 * Class AppSeeder
 *
 * Master application seeder orchestrating domain artifact seeders.
 * Allows developers to explicitly declare which tables are seeded per artifact.
 */
class AppSeeder extends Seeder
{
    /**
     * Seed the application's database with domain artifact records.
     *
     * @return void
     */
    public function run(): void
    {
        // 1. Seed Internationalization (i18n) artifact with specific tables
        $this->call(I18nDatabaseSeeder::class, false, [
            'tables' => [
                'languages',
                'locales',
                'translations',
            ],
        ]);

        // 2. Seed Geography artifact with specific tables
        $this->call(GeographyDatabaseSeeder::class, false, [
            'tables' => [
                'countries',
                'governorates',
                'cities',
                'districts',
                'locations',
            ],
        ]);
    }
}
