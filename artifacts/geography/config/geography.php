<?php

declare(strict_types=1);

/**
 * Ugarit Geography Artifact Configuration
 *
 * This configuration file serves as the canonical manifest and operational
 * configuration for the Ugarit Geography artifact. It defines architectural
 * metadata, entity models, database table bindings, spatial calculation
 * defaults, feature toggles, caching strategies, and HTTP routing parameters.
 *
 * All settings can be adjusted via environment variables or published directly
 * into the host application's `config/geography.php` directory.
 */
return [
    /**
     * --------------------------------------------------------------------------
     * Artifact Manifest & Architectural Metadata
     * --------------------------------------------------------------------------
     *
     * Detailed specification identifying the artifact within the Ugarit
     * ecosystem, including versioning, maintainer identity, and provider binding.
     */
    'manifest' => [
        'name' => 'Ugarit Geography Artifact',
        'slug' => 'geography',
        'version' => '1.00.00',
        'description' => 'Comprehensive spatial and territorial boundary management artifact for the Ugarit Ecosystem, managing countries, governorates, cities, districts, and coordinates.',
        'author' => 'Muath R Abu Ouda <muathrabuouda@hotmail.com>',
        'license' => 'MIT',
        'provider' => \Ugarit\Artifacts\Geography\Providers\GeographyServiceProvider::class,
        'tags' => [
            'geography',
            'gis',
            'boundaries',
            'spatial',
            'countries',
            'governorates',
            'cities',
            'districts',
            'locations',
        ],
    ],

    /**
     * --------------------------------------------------------------------------
     * Domain Models Registry
     * --------------------------------------------------------------------------
     *
     * Fully qualified class names of Eloquent models utilized across the geography
     * domain. Registering them here permits custom model extensions and bindings.
     */
    'models' => [
        'country' => \Ugarit\Artifacts\Geography\Models\Country::class,
        'governorate' => \Ugarit\Artifacts\Geography\Models\Governorate::class,
        'city' => \Ugarit\Artifacts\Geography\Models\City::class,
        'district' => \Ugarit\Artifacts\Geography\Models\District::class,
        'location' => \Ugarit\Artifacts\Geography\Models\Location::class,
    ],

    /**
     * --------------------------------------------------------------------------
     * Database Table Names
     * --------------------------------------------------------------------------
     *
     * Standardized database table mappings for all geography models.
     * Clean, direct names without artificial prefixes are enforced.
     */
    'tables' => [
        'countries' => env('UGARIT_GEOGRAPHY_COUNTRIES_TABLE', 'countries'),
        'governorates' => env('UGARIT_GEOGRAPHY_GOVERNORATES_TABLE', 'governorates'),
        'cities' => env('UGARIT_GEOGRAPHY_CITIES_TABLE', 'cities'),
        'districts' => env('UGARIT_GEOGRAPHY_DISTRICTS_TABLE', 'districts'),
        'locations' => env('UGARIT_GEOGRAPHY_LOCATIONS_TABLE', 'locations'),
    ],

    /**
     * --------------------------------------------------------------------------
     * Default Regional & Spatial Parameters
     * --------------------------------------------------------------------------
     *
     * Default regional parameters applied during spatial operations,
     * seeders, and fallback queries.
     */
    'defaults' => [
        /**
         * Default country ISO 3166-1 alpha-2 code.
         */
        'country' => env('UGARIT_DEFAULT_COUNTRY', 'SA'),

        /**
         * Default unit of measurement for geographical distance calculations.
         * Supported units: 'km' (Kilometers), 'mi' (Miles), 'm' (Meters).
         */
        'distance_unit' => env('UGARIT_GEOGRAPHY_DISTANCE_UNIT', 'km'),

        /**
         * Coordinate precision constraints for latitude and longitude fields.
         */
        'coordinates' => [
            'precision' => 6,
            'latitude_min' => -90.0,
            'latitude_max' => 90.0,
            'longitude_min' => -180.0,
            'longitude_max' => 180.0,
        ],
    ],

    /**
     * Backward-compatible alias for default country code.
     */
    'default_country' => env('UGARIT_DEFAULT_COUNTRY', 'SA'),

    /**
     * --------------------------------------------------------------------------
     * Feature Toggles & Capabilities
     * --------------------------------------------------------------------------
     *
     * Granular toggles allowing developers to enable or disable specific
     * territorial hierarchy tiers and behaviors.
     */
    'features' => [
        /**
         * Enable district-level sub-city territorial tier.
         */
        'enable_districts' => env('UGARIT_GEOGRAPHY_ENABLE_DISTRICTS', true),

        /**
         * Enable compound relationship traversal on Location and District entities.
         */
        'enable_compound_traversal' => env('UGARIT_GEOGRAPHY_ENABLE_COMPOUND_TRAVERSAL', true),

        /**
         * Strictly validate coordinate boundaries prior to persisting locations.
         */
        'strict_spatial_validation' => env('UGARIT_GEOGRAPHY_STRICT_VALIDATION', false),

        /**
         * Automatically generate slug identifiers when creating regions.
         */
        'auto_generate_slugs' => env('UGARIT_GEOGRAPHY_AUTO_SLUGS', true),
    ],

    /**
     * --------------------------------------------------------------------------
     * Caching & Performance Settings
     * --------------------------------------------------------------------------
     *
     * Configure caching for high-frequency territorial queries (e.g. countries
     * dropdowns, governorate hierarchies, and city listings).
     */
    'cache' => [
        /**
         * Determine if geography query results should be cached.
         */
        'enabled' => env('UGARIT_GEOGRAPHY_CACHE_ENABLED', true),

        /**
         * Cache expiration lifetime in seconds (Default: 86400 = 24 hours).
         */
        'ttl' => (int) env('UGARIT_GEOGRAPHY_CACHE_TTL', 86400),

        /**
         * Key prefix applied to all cached geography items in the storage engine.
         */
        'prefix' => env('UGARIT_GEOGRAPHY_CACHE_PREFIX', 'ugarit:geography:'),

        /**
         * Cache tags applied to cached records when supported by the cache store.
         */
        'tags' => ['ugarit', 'geography'],
    ],

    /**
     * --------------------------------------------------------------------------
     * HTTP API & Routing Configuration
     * --------------------------------------------------------------------------
     *
     * Configure HTTP routing behavior, endpoint prefixes, and middleware stacks
     * when geography routes are registered.
     */
    'routes' => [
        /**
         * Master flag to determine if built-in geography routes should be automatically booted.
         */
        'enabled' => env('UGARIT_GEOGRAPHY_ROUTES_ENABLED', true),

        /**
         * RESTful API routing configuration.
         */
        'api' => [
            'enabled' => env('UGARIT_GEOGRAPHY_API_ROUTES_ENABLED', true),
            'prefix' => env('UGARIT_GEOGRAPHY_API_PREFIX', 'api/v1/geography'),
            'middleware' => ['api'],
            'as' => 'api.geography.',
        ],

        /**
         * Local in-application web routing configuration.
         */
        'web' => [
            'enabled' => env('UGARIT_GEOGRAPHY_WEB_ROUTES_ENABLED', true),
            'prefix' => env('UGARIT_GEOGRAPHY_WEB_PREFIX', 'geography'),
            'middleware' => ['web'],
            'as' => 'geography.',
        ],

        /**
         * Subdomain routing constraint (null indicates all domains).
         */
        'domain' => env('UGARIT_GEOGRAPHY_ROUTE_DOMAIN', null),

        /**
         * Legacy backward-compatible keys.
         */
        'prefix' => env('UGARIT_GEOGRAPHY_ROUTE_PREFIX', 'api/v1/geography'),
        'middleware' => ['api'],
    ],

    /**
     * --------------------------------------------------------------------------
     * Database Seeders Registry
     * --------------------------------------------------------------------------
     *
     * Defines the master modular entrypoint seeder and individual table seeders.
     */
    'seeders' => [
        'entrypoint' => \Ugarit\Artifacts\Geography\Database\Seeders\GeographyDatabaseSeeder::class,
        'tables' => [
            'countries' => \Ugarit\Artifacts\Geography\Database\Seeders\CountrySeeder::class,
            'governorates' => \Ugarit\Artifacts\Geography\Database\Seeders\GovernorateSeeder::class,
            'cities' => \Ugarit\Artifacts\Geography\Database\Seeders\CitySeeder::class,
            'districts' => \Ugarit\Artifacts\Geography\Database\Seeders\DistrictSeeder::class,
            'locations' => \Ugarit\Artifacts\Geography\Database\Seeders\LocationSeeder::class,
        ],
    ],
];
