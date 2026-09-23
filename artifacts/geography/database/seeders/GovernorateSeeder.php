<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Database\Seeders;

use Heritage\Database\Seeder;
use Ugarit\Artifacts\Geography\Models\Country;
use Ugarit\Artifacts\Geography\Models\Governorate;

/**
 * Class GovernorateSeeder
 *
 * Seeds administrative provinces and governorates.
 * All 16 sovereign Palestinian governorates are initialized as active,
 * while other global reference governorates remain inactive.
 */
class GovernorateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $palestine = Country::where('iso_alpha_2', 'PS')->first();
        $saudiArabia = Country::where('iso_alpha_2', 'SA')->first();

        // 16 Official Palestinian Governorates
        if ($palestine) {
            $palestinianGovs = [
                ['name' => ['en' => 'Jerusalem Governorate', 'ar' => 'محافظة القدس'], 'code' => 'PS-JRS', 'is_active' => true],
                ['name' => ['en' => 'Gaza Governorate', 'ar' => 'محافظة غزة'], 'code' => 'PS-GZA', 'is_active' => true],
                ['name' => ['en' => 'North Gaza Governorate', 'ar' => 'محافظة شمال غزة'], 'code' => 'PS-NGZ', 'is_active' => true],
                ['name' => ['en' => 'Khan Yunis Governorate', 'ar' => 'محافظة خان يونس'], 'code' => 'PS-KYS', 'is_active' => true],
                ['name' => ['en' => 'Rafah Governorate', 'ar' => 'محافظة رفح'], 'code' => 'PS-RFH', 'is_active' => true],
                ['name' => ['en' => 'Deir al-Balah Governorate', 'ar' => 'محافظة دير البلح'], 'code' => 'PS-DBL', 'is_active' => true],
                ['name' => ['en' => 'Ramallah and Al-Bireh Governorate', 'ar' => 'محافظة رام الله والبيرة'], 'code' => 'PS-RMA', 'is_active' => true],
                ['name' => ['en' => 'Hebron Governorate', 'ar' => 'محافظة الخليل'], 'code' => 'PS-HBN', 'is_active' => true],
                ['name' => ['en' => 'Nablus Governorate', 'ar' => 'محافظة نابلس'], 'code' => 'PS-NBS', 'is_active' => true],
                ['name' => ['en' => 'Jenin Governorate', 'ar' => 'محافظة جنين'], 'code' => 'PS-JNN', 'is_active' => true],
                ['name' => ['en' => 'Tulkarm Governorate', 'ar' => 'محافظة طولكرم'], 'code' => 'PS-TKM', 'is_active' => true],
                ['name' => ['en' => 'Qalqilya Governorate', 'ar' => 'محافظة قلقيلية'], 'code' => 'PS-QLQ', 'is_active' => true],
                ['name' => ['en' => 'Bethlehem Governorate', 'ar' => 'محافظة بيت لحم'], 'code' => 'PS-BTM', 'is_active' => true],
                ['name' => ['en' => 'Jericho and the Jordan Valley Governorate', 'ar' => 'محافظة أريحا والأغوار'], 'code' => 'PS-JCO', 'is_active' => true],
                ['name' => ['en' => 'Salfit Governorate', 'ar' => 'محافظة سلفيت'], 'code' => 'PS-SLT', 'is_active' => true],
                ['name' => ['en' => 'Tubas Governorate', 'ar' => 'محافظة طوباس والأغوار الشمالية'], 'code' => 'PS-TBS', 'is_active' => true],
            ];

            foreach ($palestinianGovs as $gov) {
                Governorate::updateOrCreate(
                    [
                        'country_id' => $palestine->id,
                        'code' => $gov['code'],
                    ],
                    $gov
                );
            }
        }

        // Global Reference Governorates (Inactive by default)
        if ($saudiArabia) {
            $saudiGovs = [
                ['name' => ['en' => 'Riyadh Province', 'ar' => 'منطقة الرياض'], 'code' => 'SA-01', 'is_active' => false],
                ['name' => ['en' => 'Makkah Province', 'ar' => 'منطقة مكة المكرمة'], 'code' => 'SA-02', 'is_active' => false],
                ['name' => ['en' => 'Madinah Province', 'ar' => 'منطقة المدينة المنورة'], 'code' => 'SA-03', 'is_active' => false],
                ['name' => ['en' => 'Eastern Province', 'ar' => 'المنطقة الشرقية'], 'code' => 'SA-04', 'is_active' => false],
            ];

            foreach ($saudiGovs as $gov) {
                Governorate::updateOrCreate(
                    [
                        'country_id' => $saudiArabia->id,
                        'code' => $gov['code'],
                    ],
                    $gov
                );
            }
        }
    }
}
