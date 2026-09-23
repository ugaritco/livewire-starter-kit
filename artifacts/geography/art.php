<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography;

use Heritage\Support\Artifact;

return new class extends Artifact
{
    /**
     * The unique identifier for the artifact.
     */
    public string $id = 'geography';

    /**
     * The human-readable name of the artifact.
     */
    public string $name = 'Geography & Territorial Hierarchy';

    /**
     * The semantic version of the artifact.
     */
    public string $version = '1.00.00';

    /**
     * Technical capabilities provided by this artifact.
     *
     * @var array<string, string>
     */
    public array $capabilities = [
        'countries'    => 'ISO-3166 countries, capitals, currencies, dialing codes, and flags',
        'governorates' => 'First-level administrative divisions, provinces, and states',
        'cities'       => 'Cities, municipalities, and localized urban regions',
        'districts'    => 'Districts, neighborhoods, and municipal subdivisions',
        'locations'    => 'Geospatial coordinates, latitude/longitude, and addresses',
    ];

    /**
     * Service providers registered by this artifact.
     */
    public array $providers = [
        Providers\GeographyServiceProvider::class,
    ];

    /**
     * Capabilities required from other artifacts.
     */
    public array $requires = [
        'i18n.translations',
    ];

    /**
     * Bootstrap capability logic.
     */
    public function boot(): void
    {
        // Internal artifact registration
    }
};
