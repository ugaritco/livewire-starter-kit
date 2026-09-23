<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\I18n\Providers;

use Heritage\Support\ServiceProvider;

/**
 * Class I18nServiceProvider
 *
 * Service provider configuring and publishing resources for I18n artifact.
 */
class I18nServiceProvider extends ServiceProvider
{
    /**
     * Register I18n services into the service container.
     *
     * @return void
     */
    public function register(): void
    {
        // Merge configuration
        $this->mergeConfigFrom(__DIR__ . '/../../config/i18n.php', 'i18n');
    }

    /**
     * Bootstrap migrations and configuration publishers.
     *
     * @return void
     */
    public function boot(): void
    {
        // Load modular API and local Web routes when enabled in configuration
        if (config('i18n.routes.enabled', true)) {
            // Load RESTful API routes
            if (config('i18n.routes.api.enabled', true) && file_exists(__DIR__ . '/../../routes/api.php')) {
                $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');
            }

            // Load local application web routes
            if (config('i18n.routes.web.enabled', true) && file_exists(__DIR__ . '/../../routes/web.php')) {
                $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
            }
        }

        if ($this->app->runningInConsole()) {
            // Load database migrations from artifact path
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

            // Register artifact seeder entrypoint in the global seeder registry
            $this->registerArtifactSeeder('i18n', \Ugarit\Artifacts\I18n\Database\Seeders\I18nDatabaseSeeder::class);

            // Publish configuration file
            $this->publishes([
                __DIR__ . '/../../config/i18n.php' => config_path('i18n.php'),
            ], 'i18n-config');
        }
    }
}
