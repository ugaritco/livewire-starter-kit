<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\I18n\Database\Seeders;

use Heritage\Database\Seeder;
use Ugarit\Artifacts\I18n\Models\Locale;

/**
 * Class LocaleSeeder
 *
 * Seeds baseline linguistic locales.
 * Strictly activates ONLY Palestinian Arabic (ar / ar_PS, set as default RTL)
 * and American English (en / en_US, secondary LTR), with all other worldwide
 * regional locales initialized as inactive.
 */
class LocaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $locales = [
            [
                'code' => 'ar',
                'name' => [
                    'en' => 'Arabic (Palestine)',
                    'ar' => 'العربية (فلسطين)',
                ],
                'direction' => 'rtl',
                'script' => 'Arab',
                'regional' => 'ar_PS',
                'is_default' => true,
                'is_active' => true,
            ],
            [
                'code' => 'en',
                'name' => [
                    'en' => 'English (United States)',
                    'ar' => 'الإنجليزية (الولايات المتحدة)',
                ],
                'direction' => 'ltr',
                'script' => 'Latn',
                'regional' => 'en_US',
                'is_default' => false,
                'is_active' => true,
            ],
            [
                'code' => 'ar_SA',
                'name' => [
                    'en' => 'Arabic (Saudi Arabia)',
                    'ar' => 'العربية (المملكة العربية السعودية)',
                ],
                'direction' => 'rtl',
                'script' => 'Arab',
                'regional' => 'ar_SA',
                'is_default' => false,
                'is_active' => false,
            ],
            [
                'code' => 'ar_EG',
                'name' => [
                    'en' => 'Arabic (Egypt)',
                    'ar' => 'العربية (مصر)',
                ],
                'direction' => 'rtl',
                'script' => 'Arab',
                'regional' => 'ar_EG',
                'is_default' => false,
                'is_active' => false,
            ],
            [
                'code' => 'ar_JO',
                'name' => [
                    'en' => 'Arabic (Jordan)',
                    'ar' => 'العربية (الأردن)',
                ],
                'direction' => 'rtl',
                'script' => 'Arab',
                'regional' => 'ar_JO',
                'is_default' => false,
                'is_active' => false,
            ],
            [
                'code' => 'ar_SY',
                'name' => [
                    'en' => 'Arabic (Syria)',
                    'ar' => 'العربية (سوريا)',
                ],
                'direction' => 'rtl',
                'script' => 'Arab',
                'regional' => 'ar_SY',
                'is_default' => false,
                'is_active' => false,
            ],
            [
                'code' => 'ar_LB',
                'name' => [
                    'en' => 'Arabic (Lebanon)',
                    'ar' => 'العربية (لبنان)',
                ],
                'direction' => 'rtl',
                'script' => 'Arab',
                'regional' => 'ar_LB',
                'is_default' => false,
                'is_active' => false,
            ],
            [
                'code' => 'ar_AE',
                'name' => [
                    'en' => 'Arabic (United Arab Emirates)',
                    'ar' => 'العربية (الإمارات العربية المتحدة)',
                ],
                'direction' => 'rtl',
                'script' => 'Arab',
                'regional' => 'ar_AE',
                'is_default' => false,
                'is_active' => false,
            ],
            [
                'code' => 'ar_MA',
                'name' => [
                    'en' => 'Arabic (Morocco)',
                    'ar' => 'العربية (المغرب)',
                ],
                'direction' => 'rtl',
                'script' => 'Arab',
                'regional' => 'ar_MA',
                'is_default' => false,
                'is_active' => false,
            ],
            [
                'code' => 'en_GB',
                'name' => [
                    'en' => 'English (United Kingdom)',
                    'ar' => 'الإنجليزية (المملكة المتحدة)',
                ],
                'direction' => 'ltr',
                'script' => 'Latn',
                'regional' => 'en_GB',
                'is_default' => false,
                'is_active' => false,
            ],
            [
                'code' => 'en_CA',
                'name' => [
                    'en' => 'English (Canada)',
                    'ar' => 'الإنجليزية (كندا)',
                ],
                'direction' => 'ltr',
                'script' => 'Latn',
                'regional' => 'en_CA',
                'is_default' => false,
                'is_active' => false,
            ],
            [
                'code' => 'en_AU',
                'name' => [
                    'en' => 'English (Australia)',
                    'ar' => 'الإنجليزية (أستراليا)',
                ],
                'direction' => 'ltr',
                'script' => 'Latn',
                'regional' => 'en_AU',
                'is_default' => false,
                'is_active' => false,
            ],
            [
                'code' => 'fr_FR',
                'name' => [
                    'en' => 'French (France)',
                    'ar' => 'الفرنسية (فرنسا)',
                ],
                'direction' => 'ltr',
                'script' => 'Latn',
                'regional' => 'fr_FR',
                'is_default' => false,
                'is_active' => false,
            ],
            [
                'code' => 'es_ES',
                'name' => [
                    'en' => 'Spanish (Spain)',
                    'ar' => 'الإسبانية (إسبانيا)',
                ],
                'direction' => 'ltr',
                'script' => 'Latn',
                'regional' => 'es_ES',
                'is_default' => false,
                'is_active' => false,
            ],
            [
                'code' => 'de_DE',
                'name' => [
                    'en' => 'German (Germany)',
                    'ar' => 'الألمانية (ألمانيا)',
                ],
                'direction' => 'ltr',
                'script' => 'Latn',
                'regional' => 'de_DE',
                'is_default' => false,
                'is_active' => false,
            ],
            [
                'code' => 'it_IT',
                'name' => [
                    'en' => 'Italian (Italy)',
                    'ar' => 'الإيطالية (إيطاليا)',
                ],
                'direction' => 'ltr',
                'script' => 'Latn',
                'regional' => 'it_IT',
                'is_default' => false,
                'is_active' => false,
            ],
            [
                'code' => 'pt_BR',
                'name' => [
                    'en' => 'Portuguese (Brazil)',
                    'ar' => 'البرتغالية (البرازيل)',
                ],
                'direction' => 'ltr',
                'script' => 'Latn',
                'regional' => 'pt_BR',
                'is_default' => false,
                'is_active' => false,
            ],
            [
                'code' => 'ru_RU',
                'name' => [
                    'en' => 'Russian (Russia)',
                    'ar' => 'الروسية (روسيا)',
                ],
                'direction' => 'ltr',
                'script' => 'Cyrl',
                'regional' => 'ru_RU',
                'is_default' => false,
                'is_active' => false,
            ],
            [
                'code' => 'zh_CN',
                'name' => [
                    'en' => 'Chinese (Simplified, China)',
                    'ar' => 'الصينية (الصين)',
                ],
                'direction' => 'ltr',
                'script' => 'Hans',
                'regional' => 'zh_CN',
                'is_default' => false,
                'is_active' => false,
            ],
            [
                'code' => 'ja_JP',
                'name' => [
                    'en' => 'Japanese (Japan)',
                    'ar' => 'اليابانية (اليابان)',
                ],
                'direction' => 'ltr',
                'script' => 'Jpan',
                'regional' => 'ja_JP',
                'is_default' => false,
                'is_active' => false,
            ],
            [
                'code' => 'ko_KR',
                'name' => [
                    'en' => 'Korean (South Korea)',
                    'ar' => 'الكورية (كوريا الجنوبية)',
                ],
                'direction' => 'ltr',
                'script' => 'Kore',
                'regional' => 'ko_KR',
                'is_default' => false,
                'is_active' => false,
            ],
            [
                'code' => 'tr_TR',
                'name' => [
                    'en' => 'Turkish (Turkey)',
                    'ar' => 'التركية (تركيا)',
                ],
                'direction' => 'ltr',
                'script' => 'Latn',
                'regional' => 'tr_TR',
                'is_default' => false,
                'is_active' => false,
            ],
            [
                'code' => 'fa_IR',
                'name' => [
                    'en' => 'Persian (Iran)',
                    'ar' => 'الفارسية (إيران)',
                ],
                'direction' => 'rtl',
                'script' => 'Arab',
                'regional' => 'fa_IR',
                'is_default' => false,
                'is_active' => false,
            ],
            [
                'code' => 'ur_PK',
                'name' => [
                    'en' => 'Urdu (Pakistan)',
                    'ar' => 'الأردية (باكستان)',
                ],
                'direction' => 'rtl',
                'script' => 'Arab',
                'regional' => 'ur_PK',
                'is_default' => false,
                'is_active' => false,
            ],
            [
                'code' => 'hi_IN',
                'name' => [
                    'en' => 'Hindi (India)',
                    'ar' => 'الهندية (الهند)',
                ],
                'direction' => 'ltr',
                'script' => 'Deva',
                'regional' => 'hi_IN',
                'is_default' => false,
                'is_active' => false,
            ],
            [
                'code' => 'nl_NL',
                'name' => [
                    'en' => 'Dutch (Netherlands)',
                    'ar' => 'الهولندية (هولندا)',
                ],
                'direction' => 'ltr',
                'script' => 'Latn',
                'regional' => 'nl_NL',
                'is_default' => false,
                'is_active' => false,
            ],
        ];

        foreach ($locales as $locale) {
            Locale::updateOrCreate(
                ['code' => $locale['code']],
                $locale
            );
        }
    }
}
