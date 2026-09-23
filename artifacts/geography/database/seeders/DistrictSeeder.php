<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Database\Seeders;

use Heritage\Database\Seeder;
use Ugarit\Artifacts\Geography\Models\City;
use Ugarit\Artifacts\Geography\Models\District;

/**
 * Class DistrictSeeder
 *
 * Seeds municipal districts and urban neighborhoods.
 * All Palestinian districts are active by default, while others remain inactive.
 */
class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $jerusalem = City::where('postal_code', '91000')->first();
        $gaza = City::where('postal_code', '70000')->first();
        $ramallah = City::where('postal_code', '90600')->first();
        $hebron = City::where('postal_code', '90100')->first();
        $nablus = City::where('postal_code', '90200')->first();
        $bethlehem = City::where('postal_code', '90900')->first();

        $districts = [
            // Jerusalem
            ['city' => $jerusalem, 'code' => 'JRS-OLD', 'name' => ['en' => 'Old City', 'ar' => 'البلدة القديمة'], 'postal_code' => '91001'],
            ['city' => $jerusalem, 'code' => 'JRS-SJR', 'name' => ['en' => 'Sheikh Jarrah', 'ar' => 'الشيخ جراح'], 'postal_code' => '91002'],
            ['city' => $jerusalem, 'code' => 'JRS-SLW', 'name' => ['en' => 'Silwan', 'ar' => 'سلوان'], 'postal_code' => '91003'],
            ['city' => $jerusalem, 'code' => 'JRS-BHN', 'name' => ['en' => 'Beit Hanina', 'ar' => 'بيت حنينا'], 'postal_code' => '91004'],
            ['city' => $jerusalem, 'code' => 'JRS-SHF', 'name' => ['en' => 'Shu fat', 'ar' => 'شعفاط'], 'postal_code' => '91005'],
            // Gaza City
            ['city' => $gaza, 'code' => 'GZA-RML', 'name' => ['en' => 'Al-Rimal', 'ar' => 'حي الرمال'], 'postal_code' => '70001'],
            ['city' => $gaza, 'code' => 'GZA-ZYT', 'name' => ['en' => 'Al-Zaytoun', 'ar' => 'حي الزيتون'], 'postal_code' => '70002'],
            ['city' => $gaza, 'code' => 'GZA-SHJ', 'name' => ['en' => 'Al-Shuja iyya', 'ar' => 'حي الشجاعية'], 'postal_code' => '70003'],
            ['city' => $gaza, 'code' => 'GZA-THW', 'name' => ['en' => 'Tal al-Hawa', 'ar' => 'تل الهوى'], 'postal_code' => '70004'],
            ['city' => $gaza, 'code' => 'GZA-SRD', 'name' => ['en' => 'Sheikh Radwan', 'ar' => 'الشيخ رضوان'], 'postal_code' => '70005'],
            // Ramallah
            ['city' => $ramallah, 'code' => 'RMA-MSY', 'name' => ['en' => 'Al-Masyoun', 'ar' => 'حي الماصيون'], 'postal_code' => '90601'],
            ['city' => $ramallah, 'code' => 'RMA-TRR', 'name' => ['en' => 'Al-Tireh', 'ar' => 'حي الطيرة'], 'postal_code' => '90602'],
            ['city' => $ramallah, 'code' => 'RMA-EMN', 'name' => ['en' => 'Ein Munjid', 'ar' => 'عين منجد'], 'postal_code' => '90603'],
            // Hebron
            ['city' => $hebron, 'code' => 'HBN-BZW', 'name' => ['en' => 'Bab Al-Zawiya', 'ar' => 'باب الزاوية'], 'postal_code' => '90101'],
            ['city' => $hebron, 'code' => 'HBN-HRM', 'name' => ['en' => 'Al-Haram Area', 'ar' => 'منطقة الحرم'], 'postal_code' => '90102'],
            ['city' => $hebron, 'code' => 'HBN-ESR', 'name' => ['en' => 'Ein Sara', 'ar' => 'شارع عين سارة'], 'postal_code' => '90103'],
            // Nablus
            ['city' => $nablus, 'code' => 'NBS-RFD', 'name' => ['en' => 'Rafidia', 'ar' => 'رفيديا'], 'postal_code' => '90201'],
            ['city' => $nablus, 'code' => 'NBS-OLD', 'name' => ['en' => 'Old City of Nablus', 'ar' => 'البلدة القديمة نابلس'], 'postal_code' => '90202'],
            // Bethlehem
            ['city' => $bethlehem, 'code' => 'BTM-MNG', 'name' => ['en' => 'Manger Square', 'ar' => 'منطقة ساحة المهد'], 'postal_code' => '90901'],
        ];

        foreach ($districts as $item) {
            if (! $item['city']) {
                continue;
            }

            District::updateOrCreate(
                [
                    'city_id' => $item['city']->id,
                    'code' => $item['code'],
                ],
                [
                    'name' => $item['name'],
                    'postal_code' => $item['postal_code'],
                    'is_active' => true,
                ]
            );
        }

        // Global Reference District (Inactive)
        $riyadh = City::where('postal_code', '11564')->first();
        if ($riyadh) {
            District::updateOrCreate(
                [
                    'city_id' => $riyadh->id,
                    'code' => 'RUH-OLY',
                ],
                [
                    'name' => ['en' => 'Al-Olaya', 'ar' => 'العليا'],
                    'postal_code' => '12211',
                    'is_active' => false,
                ]
            );
        }
    }
}
