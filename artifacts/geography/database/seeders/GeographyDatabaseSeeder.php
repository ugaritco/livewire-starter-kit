<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Database\Seeders;

use Heritage\Database\ArtifactSeeder;

/**
 * Class GeographyDatabaseSeeder
 *
 * Master artifact database seeder for the Ugarit Geography ecosystem.
 * Orchestrates entity seeders across the territorial hierarchy:
 * Countries -> Governorates -> Cities -> Districts -> Locations.
 *
 * Supports selective table seeding when executed from application-level
 * orchestrators such as AppSeeder.
 */
class GeographyDatabaseSeeder extends ArtifactSeeder
{
    /**
     * Map of geography domain tables to their dedicated seeder classes.
     *
     * @var array<string, class-string<\Heritage\Database\Seeder>>
     */
    protected array $tableSeeders = [
        'countries' => CountrySeeder::class,
        'governorates' => GovernorateSeeder::class,
        'cities' => CitySeeder::class,
        'districts' => DistrictSeeder::class,
        'locations' => LocationSeeder::class,
    ];
}
