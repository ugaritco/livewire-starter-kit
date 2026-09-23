<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\I18n\Database\Seeders;

use Heritage\Database\Seeder;
use Ugarit\Artifacts\I18n\Models\Language;

/**
 * Class LanguageSeeder
 *
 * Seeds recognized international world languages with ISO-639-1 standards.
 * Strictly activates ONLY Arabic (ar) and English (en) by default,
 * with all other global languages initialized as inactive.
 */
class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $languages = [
            [
                'iso_code' => 'ar',
                'name' => [
                    'en' => 'Arabic',
                    'ar' => 'العربية',
                ],
                'native_name' => 'العربية',
                'is_active' => true,
            ],
            [
                'iso_code' => 'en',
                'name' => [
                    'en' => 'English',
                    'ar' => 'الإنجليزية',
                ],
                'native_name' => 'English',
                'is_active' => true,
            ],
            [
                'iso_code' => 'fr',
                'name' => [
                    'en' => 'French',
                    'ar' => 'الفرنسية',
                ],
                'native_name' => 'Français',
                'is_active' => false,
            ],
            [
                'iso_code' => 'es',
                'name' => [
                    'en' => 'Spanish',
                    'ar' => 'الإسبانية',
                ],
                'native_name' => 'Español',
                'is_active' => false,
            ],
            [
                'iso_code' => 'de',
                'name' => [
                    'en' => 'German',
                    'ar' => 'الألمانية',
                ],
                'native_name' => 'Deutsch',
                'is_active' => false,
            ],
            [
                'iso_code' => 'zh',
                'name' => [
                    'en' => 'Chinese',
                    'ar' => 'الصينية',
                ],
                'native_name' => '中文',
                'is_active' => false,
            ],
            [
                'iso_code' => 'ru',
                'name' => [
                    'en' => 'Russian',
                    'ar' => 'الروسية',
                ],
                'native_name' => 'Русский',
                'is_active' => false,
            ],
            [
                'iso_code' => 'ja',
                'name' => [
                    'en' => 'Japanese',
                    'ar' => 'اليابانية',
                ],
                'native_name' => '日本語',
                'is_active' => false,
            ],
            [
                'iso_code' => 'pt',
                'name' => [
                    'en' => 'Portuguese',
                    'ar' => 'البرتغالية',
                ],
                'native_name' => 'Português',
                'is_active' => false,
            ],
            [
                'iso_code' => 'it',
                'name' => [
                    'en' => 'Italian',
                    'ar' => 'الإيطالية',
                ],
                'native_name' => 'Italiano',
                'is_active' => false,
            ],
            [
                'iso_code' => 'tr',
                'name' => [
                    'en' => 'Turkish',
                    'ar' => 'التركية',
                ],
                'native_name' => 'Türkçe',
                'is_active' => false,
            ],
            [
                'iso_code' => 'fa',
                'name' => [
                    'en' => 'Persian',
                    'ar' => 'الفارسية',
                ],
                'native_name' => 'فارسی',
                'is_active' => false,
            ],
            [
                'iso_code' => 'ur',
                'name' => [
                    'en' => 'Urdu',
                    'ar' => 'الأردية',
                ],
                'native_name' => 'اردو',
                'is_active' => false,
            ],
            [
                'iso_code' => 'hi',
                'name' => [
                    'en' => 'Hindi',
                    'ar' => 'الهندية',
                ],
                'native_name' => 'हिन्दी',
                'is_active' => false,
            ],
            [
                'iso_code' => 'ko',
                'name' => [
                    'en' => 'Korean',
                    'ar' => 'الكورية',
                ],
                'native_name' => '한국어',
                'is_active' => false,
            ],
            [
                'iso_code' => 'id',
                'name' => [
                    'en' => 'Indonesian',
                    'ar' => 'الإندونيسية',
                ],
                'native_name' => 'Bahasa Indonesia',
                'is_active' => false,
            ],
            [
                'iso_code' => 'ms',
                'name' => [
                    'en' => 'Malay',
                    'ar' => 'الملايوية',
                ],
                'native_name' => 'Bahasa Melayu',
                'is_active' => false,
            ],
            [
                'iso_code' => 'nl',
                'name' => [
                    'en' => 'Dutch',
                    'ar' => 'الهولندية',
                ],
                'native_name' => 'Nederlands',
                'is_active' => false,
            ],
            [
                'iso_code' => 'pl',
                'name' => [
                    'en' => 'Polish',
                    'ar' => 'البولندية',
                ],
                'native_name' => 'Polski',
                'is_active' => false,
            ],
            [
                'iso_code' => 'sv',
                'name' => [
                    'en' => 'Swedish',
                    'ar' => 'السويدية',
                ],
                'native_name' => 'Svenska',
                'is_active' => false,
            ],
            [
                'iso_code' => 'el',
                'name' => [
                    'en' => 'Greek',
                    'ar' => 'اليونانية',
                ],
                'native_name' => 'Ελληνικά',
                'is_active' => false,
            ],
            [
                'iso_code' => 'he',
                'name' => [
                    'en' => 'Hebrew',
                    'ar' => 'العبرية',
                ],
                'native_name' => 'עבריت',
                'is_active' => false,
            ],
            [
                'iso_code' => 'sw',
                'name' => [
                    'en' => 'Swahili',
                    'ar' => 'السواحيلية',
                ],
                'native_name' => 'Kiswahili',
                'is_active' => false,
            ],
            [
                'iso_code' => 'bn',
                'name' => [
                    'en' => 'Bengali',
                    'ar' => 'البنغالية',
                ],
                'native_name' => 'বাংলা',
                'is_active' => false,
            ],
            [
                'iso_code' => 'vi',
                'name' => [
                    'en' => 'Vietnamese',
                    'ar' => 'الفيتنامية',
                ],
                'native_name' => 'Tiếng Việt',
                'is_active' => false,
            ],
            [
                'iso_code' => 'th',
                'name' => [
                    'en' => 'Thai',
                    'ar' => 'التايلاندية',
                ],
                'native_name' => 'ไทย',
                'is_active' => false,
            ],
            [
                'iso_code' => 'uk',
                'name' => [
                    'en' => 'Ukrainian',
                    'ar' => 'الأوكرانية',
                ],
                'native_name' => 'Українська',
                'is_active' => false,
            ],
            [
                'iso_code' => 'ro',
                'name' => [
                    'en' => 'Romanian',
                    'ar' => 'الرومانية',
                ],
                'native_name' => 'Română',
                'is_active' => false,
            ],
            [
                'iso_code' => 'hu',
                'name' => [
                    'en' => 'Hungarian',
                    'ar' => 'المجرية',
                ],
                'native_name' => 'Magyar',
                'is_active' => false,
            ],
            [
                'iso_code' => 'cs',
                'name' => [
                    'en' => 'Czech',
                    'ar' => 'التشيكية',
                ],
                'native_name' => 'Čeština',
                'is_active' => false,
            ],
            [
                'iso_code' => 'da',
                'name' => [
                    'en' => 'Danish',
                    'ar' => 'الدنماركية',
                ],
                'native_name' => 'Dansk',
                'is_active' => false,
            ],
            [
                'iso_code' => 'fi',
                'name' => [
                    'en' => 'Finnish',
                    'ar' => 'الفنلندية',
                ],
                'native_name' => 'Suomi',
                'is_active' => false,
            ],
            [
                'iso_code' => 'no',
                'name' => [
                    'en' => 'Norwegian',
                    'ar' => 'النرويجية',
                ],
                'native_name' => 'Norsk',
                'is_active' => false,
            ],
        ];

        foreach ($languages as $language) {
            Language::updateOrCreate(
                ['iso_code' => $language['iso_code']],
                $language
            );
        }
    }
}
