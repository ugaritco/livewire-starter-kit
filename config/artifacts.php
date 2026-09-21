<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Modular Artifacts System Enabled
    |--------------------------------------------------------------------------
    |
    | This value determines whether the internal modular artifacts (modules)
    | system is active across the Ugarit application. When disabled, no
    | modular artifact providers will be automatically registered or booted.
    |
    */

    'enabled' => env('ARTIFACTS_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Artifacts Directory Path
    |--------------------------------------------------------------------------
    |
    | The base filesystem path where modular artifacts are located.
    | By default, this points to the "artifacts" directory in the project root.
    |
    */

    'path' => base_path('artifacts'),

    /*
    |--------------------------------------------------------------------------
    | Modular Autodiscovery
    |--------------------------------------------------------------------------
    |
    | When enabled, Ugarit automatically scans the artifacts directory
    | for modular packages, reading their art.php or composer.json files,
    | and registering their service providers dynamically.
    |
    */

    'autodiscovery' => env('ARTIFACTS_AUTODISCOVERY', true),

    /*
    |--------------------------------------------------------------------------
    | Explicit Artifact Service Providers
    |--------------------------------------------------------------------------
    |
    | You can explicitly list modular artifact service providers here.
    | These providers will always be registered when artifacts are enabled,
    | even if autodiscovery is disabled.
    |
    */

    'providers' => [
        // Ugarit\Artifacts\Geography\Providers\GeographyServiceProvider::class,
        // Ugarit\Artifacts\I18n\Providers\I18nServiceProvider::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Artifact States & Toggles
    |--------------------------------------------------------------------------
    |
    | You can enable or disable individual modular artifacts by their ID or folder name.
    | Set any artifact to false to prevent its service providers and routes from loading.
    |
    */

    'artifacts' => [
        'i18n' => true,
        'geography' => true,
    ],

];
