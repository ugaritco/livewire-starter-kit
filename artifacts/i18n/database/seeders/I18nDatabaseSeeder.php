<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\I18n\Database\Seeders;

use Heritage\Database\ArtifactSeeder;

/**
 * Class I18nDatabaseSeeder
 *
 * Master artifact database seeder for the Ugarit Internationalization (i18n) ecosystem.
 * Orchestrates entity seeders across Languages -> Locales -> Translations.
 *
 * Supports selective table seeding when executed from application-level
 * orchestrators such as AppSeeder.
 */
class I18nDatabaseSeeder extends ArtifactSeeder
{
    /**
     * Map of i18n domain tables to their dedicated seeder classes.
     *
     * @var array<string, class-string<\Heritage\Database\Seeder>>
     */
    protected array $tableSeeders = [
        'languages' => LanguageSeeder::class,
        'locales' => LocaleSeeder::class,
        'translations' => TranslationSeeder::class,
    ];
}
