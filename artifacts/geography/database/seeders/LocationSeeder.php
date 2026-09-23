<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Database\Seeders;

use Heritage\Database\Seeder;
use Ugarit\Artifacts\Geography\Models\City;
use Ugarit\Artifacts\Geography\Models\District;
use Ugarit\Artifacts\Geography\Models\Location;

/**
 * Class LocationSeeder
 *
 * Seeds prominent landmarks, sovereign monuments, and historic institutions.
 * Palestinian heritage monuments and holy sites are seeded as active,
 * while others remain inactive.
 */
class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $jerusalem = City::where('postal_code', '91000')->first();
        $oldCityJrs = District::where('code', 'JRS-OLD')->first();

        $hebron = City::where('postal_code', '90100')->first();
        $haramAreaHbn = District::where('code', 'HBN-HRM')->first();

        $bethlehem = City::where('postal_code', '90900')->first();
        $mangerDist = District::where('code', 'BTM-MNG')->first();

        $gaza = City::where('postal_code', '70000')->first();
        $rimalGza = District::where('code', 'GZA-RML')->first();

        $nablus = City::where('postal_code', '90200')->first();
        $oldCityNbs = District::where('code', 'NBS-OLD')->first();

        $jericho = City::where('postal_code', '90800')->first();

        $locations = [
            [
                'city_id' => $jerusalem?->id,
                'district_id' => $oldCityJrs?->id,
                'name' => [
                    'en' => 'Al-Aqsa Mosque Compound',
                    'ar' => 'المسجد الأقصى المبارك',
                ],
                'latitude' => 31.7761000,
                'longitude' => 35.2358000,
                'address_line' => [
                    'en' => 'Old City, Jerusalem',
                    'ar' => 'ساحات الحرم القدسي الشريف، البلدة القديمة، القدس',
                ],
                'postal_code' => '91001',
            ],
            [
                'city_id' => $jerusalem?->id,
                'district_id' => $oldCityJrs?->id,
                'name' => [
                    'en' => 'Dome of the Rock',
                    'ar' => 'قبة الصخرة المشرفة',
                ],
                'latitude' => 31.7780000,
                'longitude' => 35.2354000,
                'address_line' => [
                    'en' => 'Al-Aqsa Compound, Old City, Jerusalem',
                    'ar' => 'صحن قبة الصخرة، المسجد الأقصى، القدس الشريف',
                ],
                'postal_code' => '91002',
            ],
            [
                'city_id' => $jerusalem?->id,
                'district_id' => $oldCityJrs?->id,
                'name' => [
                    'en' => 'Church of the Holy Sepulchre',
                    'ar' => 'كنيسة القيامة',
                ],
                'latitude' => 31.7785000,
                'longitude' => 35.2298000,
                'address_line' => [
                    'en' => 'Christian Quarter, Old City, Jerusalem',
                    'ar' => 'حارة النصارى، البلدة القديمة، القدس الشريف',
                ],
                'postal_code' => '91003',
            ],
            [
                'city_id' => $hebron?->id,
                'district_id' => $haramAreaHbn?->id,
                'name' => [
                    'en' => 'Ibrahimi Mosque',
                    'ar' => 'الحرم الإبراهيمي الشريف',
                ],
                'latitude' => 31.5247000,
                'longitude' => 35.1107000,
                'address_line' => [
                    'en' => 'Old City, Hebron',
                    'ar' => 'منطقة الحرم، البلدة القديمة، الخليل',
                ],
                'postal_code' => '90102',
            ],
            [
                'city_id' => $bethlehem?->id,
                'district_id' => $mangerDist?->id,
                'name' => [
                    'en' => 'Church of the Nativity',
                    'ar' => 'كنيسة المهد',
                ],
                'latitude' => 31.7043000,
                'longitude' => 35.2076000,
                'address_line' => [
                    'en' => 'Manger Square, Bethlehem',
                    'ar' => 'ساحة المهد، بيت لحم',
                ],
                'postal_code' => '90901',
            ],
            [
                'city_id' => $gaza?->id,
                'district_id' => $rimalGza?->id,
                'name' => [
                    'en' => 'Great Omari Mosque',
                    'ar' => 'الجامع العمري الكبير',
                ],
                'latitude' => 31.5042000,
                'longitude' => 34.4647000,
                'address_line' => [
                    'en' => 'Al-Daraj, Gaza City',
                    'ar' => 'حي الدرج، غزة',
                ],
                'postal_code' => '70001',
            ],
            [
                'city_id' => $jericho?->id,
                'district_id' => null,
                'name' => [
                    'en' => 'Hisham s Palace',
                    'ar' => 'قصر هشام بن عبد الملك',
                ],
                'latitude' => 31.8828000,
                'longitude' => 35.4597000,
                'address_line' => [
                    'en' => 'Khirbat al-Mafjar, Jericho',
                    'ar' => 'خربة المفجر، أريحا',
                ],
                'postal_code' => '90801',
            ],
        ];

        foreach ($locations as $location) {
            if ($location['city_id'] === null) {
                continue;
            }

            Location::updateOrCreate(
                [
                    'city_id' => $location['city_id'],
                    'postal_code' => $location['postal_code'],
                ],
                $location
            );
        }
    }
}
