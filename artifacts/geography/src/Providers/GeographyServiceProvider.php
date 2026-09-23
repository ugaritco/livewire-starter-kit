<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Providers;

use Heritage\Support\ServiceProvider;

/**
 * Class GeographyServiceProvider
 *
 * Service provider configuring and publishing resources for Geography artifact.
 */
class GeographyServiceProvider extends ServiceProvider
{
    /**
     * Register geography services into the IoC container.
     *
     * @return void
     */
    public function register(): void
    {
        // Merge configuration settings
        $this->mergeConfigFrom(__DIR__ . '/../../config/geography.php', 'geography');
    }

    /**
     * Bootstrap migrations and configuration publishers.
     *
     * @return void
     */
    public function boot(): void
    {
        // Load modular API and local Web routes when enabled in configuration
        if (config('geography.routes.enabled', true)) {
            // Load RESTful API routes
            if (config('geography.routes.api.enabled', true) && file_exists(__DIR__ . '/../../routes/api.php')) {
                $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');
            }

            // Load local application web routes
            if (config('geography.routes.web.enabled', true) && file_exists(__DIR__ . '/../../routes/web.php')) {
                $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
            }
        }

        if ($this->app->runningInConsole()) {
            // Load database migrations from artifact path
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

            // Register artifact seeder entrypoint in the global seeder registry
            $this->registerArtifactSeeder('geography', \Ugarit\Artifacts\Geography\Database\Seeders\GeographyDatabaseSeeder::class);

            // Publish configuration file
            $this->publishes([
                __DIR__ . '/../../config/geography.php' => config_path('geography.php'),
            ], 'geography-config');
        }
    }
}
