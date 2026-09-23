<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\I18n;

use Heritage\Support\Artifact;

/**
 * Ugarit Internationalization (i18n) Artifact Manifest
 *
 * Declares identity, technical capabilities, and service providers for internationalization.
 */
return new class extends Artifact
{
    /**
     * The unique identifier for the artifact.
     *
     * @var string
     */
    public string $id = 'i18n';

    /**
     * The human-readable name of the artifact.
     *
     * @var string
     */
    public string $name = 'Internationalization & Localization';

    /**
     * The semantic version of the artifact.
     *
     * @var string
     */
    public string $version = '1.00.00';

    /**
     * Technical capabilities provided by this artifact.
     *
     * @var array<string, string>
     */
    public array $capabilities = [
        'locales'      => 'Locale management, fallback hierarchy, and directional resolution (RTL/LTR)',
        'languages'    => 'Language catalog, ISO-639 codes, and native denomination registry',
        'translations' => 'Dynamic entity translatable attributes and multilingual dictionary storage',
    ];

    /**
     * Service providers registered by this artifact.
     *
     * @var array<int, class-string>
     */
    public array $providers = [
        Providers\I18nServiceProvider::class,
    ];

    /**
     * Capabilities required from other artifacts.
     *
     * @var array<string, string>
     */
    public array $requires = [];

    /**
     * Bootstrap capability logic for this artifact.
     *
     * @return void
     */
    public function boot(): void
    {
        // Perform internal artifact initialization
    }
};
