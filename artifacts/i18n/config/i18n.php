<?php

declare(strict_types=1);

/**
 * Ugarit Internationalization (i18n) Artifact Configuration
 *
 * This configuration file serves as the canonical manifest and operational
 * configuration for the Ugarit Internationalization (i18n) artifact. It defines
 * architectural metadata, entity models, database table bindings, locale
 * resolution rules, supported languages, fallback cascading, caching, and routing.
 *
 * All settings can be adjusted via environment variables or published directly
 * into the host application's `config/i18n.php` directory.
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
        'name' => 'Ugarit Internationalization (i18n) Artifact',
        'slug' => 'i18n',
        'version' => '1.00.00',
        'description' => 'Core localization, language resolution, dynamic content translation, and multilingual routing artifact for the Ugarit Ecosystem.',
        'author' => 'Muath R Abu Ouda <muathrabuouda@hotmail.com>',
        'license' => 'MIT',
        'provider' => \Ugarit\Artifacts\I18n\Providers\I18nServiceProvider::class,
        'tags' => [
            'i18n',
            'localization',
            'locales',
            'languages',
            'translations',
            'multilingual',
            'rtl',
        ],
    ],

    /**
     * --------------------------------------------------------------------------
     * Domain Models Registry
     * --------------------------------------------------------------------------
     *
     * Fully qualified class names of Eloquent models utilized across the i18n
     * domain. Registering them here permits custom model extensions and bindings.
     */
    'models' => [
        'locale' => \Ugarit\Artifacts\I18n\Models\Locale::class,
        'language' => \Ugarit\Artifacts\I18n\Models\Language::class,
        'translation' => \Ugarit\Artifacts\I18n\Models\Translation::class,
    ],

    /**
     * --------------------------------------------------------------------------
     * Database Table Names
     * --------------------------------------------------------------------------
     *
     * Standardized database table mappings for all internationalization models.
     * Clean, direct names without artificial prefixes are enforced.
     */
    'tables' => [
        'locales' => env('UGARIT_I18N_LOCALES_TABLE', 'locales'),
        'languages' => env('UGARIT_I18N_LANGUAGES_TABLE', 'languages'),
        'translations' => env('UGARIT_I18N_TRANSLATIONS_TABLE', 'translations'),
    ],

    /**
     * --------------------------------------------------------------------------
     * Default Regional & Language Resolution
     * --------------------------------------------------------------------------
     *
     * Default and fallback language identifiers utilized across the application.
     */
    'defaults' => [
        /**
         * Primary application locale code (ISO 639-1 / BCP 47).
         */
        'locale' => env('UGARIT_LOCALE', 'ar'),

        /**
         * Fallback locale code when translations in primary locale are missing.
         */
        'fallback_locale' => env('UGARIT_FALLBACK_LOCALE', 'en'),

        /**
         * Default text reading direction ('rtl' or 'ltr').
         */
        'direction' => 'rtl',

        /**
         * Default script code (ISO 15924).
         */
        'script' => 'Arab',
    ],

    /**
     * Backward-compatible aliases for locale resolution.
     */
    'default_locale' => env('UGARIT_LOCALE', 'ar'),
    'fallback_locale' => env('UGARIT_FALLBACK_LOCALE', 'en'),

    /**
     * --------------------------------------------------------------------------
     * Supported Locales & Linguistic Metadata
     * --------------------------------------------------------------------------
     *
     * Comprehensive linguistic and layout metadata for every enabled locale
     * in the application.
     */
    'supported_locales' => [
        'ar' => [
            'code' => 'ar',
            'name' => 'Arabic',
            'native' => 'العربية',
            'direction' => 'rtl',
            'script' => 'Arab',
            'regional' => 'ar_SA',
            'flag' => '🇸🇦',
        ],
        'en' => [
            'code' => 'en',
            'name' => 'English',
            'native' => 'English',
            'direction' => 'ltr',
            'script' => 'Latn',
            'regional' => 'en_US',
            'flag' => '🇺🇸',
        ],
    ],

    /**
     * --------------------------------------------------------------------------
     * Feature Toggles & Capabilities
     * --------------------------------------------------------------------------
     *
     * Granular toggles allowing developers to configure translation resolution,
     * browser detection, and persistence behavior.
     */
    'features' => [
        /**
         * Enable hierarchical fallback cascading (e.g. ar_EG -> ar -> en).
         */
        'cascade_fallback' => env('UGARIT_I18N_CASCADE_FALLBACK', true),

        /**
         * Automatically detect user preferred locale from HTTP Accept-Language headers.
         */
        'auto_detect_browser_locale' => env('UGARIT_I18N_AUTO_DETECT', true),

        /**
         * Persist missing translation keys automatically to the database for translators.
         */
        'persist_missing_keys' => env('UGARIT_I18N_PERSIST_MISSING_KEYS', false),

        /**
         * Enforce strict locale validation (reject unregistered locales with 404).
         */
        'strict_locales_only' => env('UGARIT_I18N_STRICT_LOCALES', false),
    ],

    /**
     * --------------------------------------------------------------------------
     * Caching & Performance Settings
     * --------------------------------------------------------------------------
     *
     * Configure caching for high-frequency translation lookups and language sets.
     */
    'cache' => [
        /**
         * Determine if translation query results should be cached in memory/store.
         */
        'enabled' => env('UGARIT_I18N_CACHE_ENABLED', true),

        /**
         * Cache expiration lifetime in seconds (Default: 86400 = 24 hours).
         */
        'ttl' => (int) env('UGARIT_I18N_CACHE_TTL', 86400),

        /**
         * Key prefix applied to all cached i18n items in the storage engine.
         */
        'prefix' => env('UGARIT_I18N_CACHE_PREFIX', 'ugarit:i18n:'),

        /**
         * Cache tags applied to cached translation records when supported.
         */
        'tags' => ['ugarit', 'i18n'],
    ],

    /**
     * --------------------------------------------------------------------------
     * HTTP API & Routing Configuration
     * --------------------------------------------------------------------------
     *
     * Configure HTTP routing behavior, endpoint prefixes, and middleware stacks
     * when i18n management routes are registered.
     */
    'routes' => [
        /**
         * Master flag to determine if built-in i18n routes should be automatically booted.
         */
        'enabled' => env('UGARIT_I18N_ROUTES_ENABLED', true),

        /**
         * RESTful API routing configuration.
         */
        'api' => [
            'enabled' => env('UGARIT_I18N_API_ROUTES_ENABLED', true),
            'prefix' => env('UGARIT_I18N_API_PREFIX', 'api/v1/i18n'),
            'middleware' => ['api'],
            'as' => 'api.i18n.',
        ],

        /**
         * Local in-application web routing configuration.
         */
        'web' => [
            'enabled' => env('UGARIT_I18N_WEB_ROUTES_ENABLED', true),
            'prefix' => env('UGARIT_I18N_WEB_PREFIX', 'i18n'),
            'middleware' => ['web'],
            'as' => 'i18n.',
        ],

        /**
         * Subdomain routing constraint (null indicates all domains).
         */
        'domain' => env('UGARIT_I18N_ROUTE_DOMAIN', null),

        /**
         * Legacy backward-compatible keys.
         */
        'prefix' => env('UGARIT_I18N_ROUTE_PREFIX', 'api/v1/i18n'),
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
        'entrypoint' => \Ugarit\Artifacts\I18n\Database\Seeders\I18nDatabaseSeeder::class,
        'tables' => [
            'languages' => \Ugarit\Artifacts\I18n\Database\Seeders\LanguageSeeder::class,
            'locales' => \Ugarit\Artifacts\I18n\Database\Seeders\LocaleSeeder::class,
            'translations' => \Ugarit\Artifacts\I18n\Database\Seeders\TranslationSeeder::class,
        ],
    ],
];
