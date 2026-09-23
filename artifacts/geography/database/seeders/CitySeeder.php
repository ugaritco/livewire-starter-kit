<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Geography\Database\Seeders;

use Heritage\Database\Seeder;
use Ugarit\Artifacts\Geography\Models\City;
use Ugarit\Artifacts\Geography\Models\Governorate;

/**
 * Class CitySeeder
 *
 * Seeds primary cities and metropolitan municipalities.
 * All Palestinian cities are seeded as active, while global reference cities
 * are seeded as inactive.
 */
class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $palestineGovs = Governorate::where('code', 'like', 'PS-%')->get()->keyBy('code');

        $palestinianCities = [
            // Jerusalem
            ['gov' => 'PS-JRS', 'name' => ['en' => 'Jerusalem', 'ar' => 'القدس الشريف'], 'postal_code' => '91000'],
            ['gov' => 'PS-JRS', 'name' => ['en' => 'Abu Dis', 'ar' => 'أبو ديس'], 'postal_code' => '91010'],
            ['gov' => 'PS-JRS', 'name' => ['en' => 'Al-Eizariya', 'ar' => 'العيزرية'], 'postal_code' => '91020'],
            // Gaza
            ['gov' => 'PS-GZA', 'name' => ['en' => 'Gaza City', 'ar' => 'مدينة غزة'], 'postal_code' => '70000'],
            // North Gaza
            ['gov' => 'PS-NGZ', 'name' => ['en' => 'Jabalia', 'ar' => 'جباليا'], 'postal_code' => '71000'],
            ['gov' => 'PS-NGZ', 'name' => ['en' => 'Beit Lahia', 'ar' => 'بيت لاهيا'], 'postal_code' => '71010'],
            ['gov' => 'PS-NGZ', 'name' => ['en' => 'Beit Hanoun', 'ar' => 'بيت حانون'], 'postal_code' => '71020'],
            // Khan Yunis
            ['gov' => 'PS-KYS', 'name' => ['en' => 'Khan Yunis', 'ar' => 'خان يونس'], 'postal_code' => '72000'],
            ['gov' => 'PS-KYS', 'name' => ['en' => 'Bani Suheila', 'ar' => 'بني سهيلا'], 'postal_code' => '72010'],
            // Rafah
            ['gov' => 'PS-RFH', 'name' => ['en' => 'Rafah', 'ar' => 'رفح'], 'postal_code' => '73000'],
            // Deir al-Balah
            ['gov' => 'PS-DBL', 'name' => ['en' => 'Deir al-Balah', 'ar' => 'دير البلح'], 'postal_code' => '74000'],
            ['gov' => 'PS-DBL', 'name' => ['en' => 'Al-Nuseirat', 'ar' => 'النصيرات'], 'postal_code' => '74010'],
            ['gov' => 'PS-DBL', 'name' => ['en' => 'Al-Bureij', 'ar' => 'البريج'], 'postal_code' => '74020'],
            // Ramallah and Al-Bireh
            ['gov' => 'PS-RMA', 'name' => ['en' => 'Ramallah', 'ar' => 'رام الله'], 'postal_code' => '90600'],
            ['gov' => 'PS-RMA', 'name' => ['en' => 'Al-Bireh', 'ar' => 'البيرة'], 'postal_code' => '90610'],
            ['gov' => 'PS-RMA', 'name' => ['en' => 'Beitunia', 'ar' => 'بيتونيا'], 'postal_code' => '90620'],
            ['gov' => 'PS-RMA', 'name' => ['en' => 'Rawabi', 'ar' => 'روابي'], 'postal_code' => '90630'],
            // Hebron
            ['gov' => 'PS-HBN', 'name' => ['en' => 'Hebron', 'ar' => 'الخليل'], 'postal_code' => '90100'],
            ['gov' => 'PS-HBN', 'name' => ['en' => 'Halhul', 'ar' => 'حلحول'], 'postal_code' => '90110'],
            ['gov' => 'PS-HBN', 'name' => ['en' => 'Dura', 'ar' => 'دورا'], 'postal_code' => '90120'],
            ['gov' => 'PS-HBN', 'name' => ['en' => 'Yatta', 'ar' => 'يطا'], 'postal_code' => '90130'],
            // Nablus
            ['gov' => 'PS-NBS', 'name' => ['en' => 'Nablus', 'ar' => 'نابلس'], 'postal_code' => '90200'],
            ['gov' => 'PS-NBS', 'name' => ['en' => 'Huwara', 'ar' => 'حوارة'], 'postal_code' => '90210'],
            ['gov' => 'PS-NBS', 'name' => ['en' => 'Sebastia', 'ar' => 'سبسطية'], 'postal_code' => '90220'],
            // Jenin
            ['gov' => 'PS-JNN', 'name' => ['en' => 'Jenin', 'ar' => 'جنين'], 'postal_code' => '90300'],
            ['gov' => 'PS-JNN', 'name' => ['en' => 'Ya bad', 'ar' => 'يعبد'], 'postal_code' => '90310'],
            // Tulkarm
            ['gov' => 'PS-TKM', 'name' => ['en' => 'Tulkarm', 'ar' => 'طولكرم'], 'postal_code' => '90400'],
            ['gov' => 'PS-TKM', 'name' => ['en' => 'Anabta', 'ar' => 'عنبتا'], 'postal_code' => '90410'],
            // Qalqilya
            ['gov' => 'PS-QLQ', 'name' => ['en' => 'Qalqilya', 'ar' => 'قلقيلية'], 'postal_code' => '90500'],
            ['gov' => 'PS-QLQ', 'name' => ['en' => 'Azzun', 'ar' => 'عزون'], 'postal_code' => '90510'],
            // Bethlehem
            ['gov' => 'PS-BTM', 'name' => ['en' => 'Bethlehem', 'ar' => 'بيت لحم'], 'postal_code' => '90900'],
            ['gov' => 'PS-BTM', 'name' => ['en' => 'Beit Jala', 'ar' => 'بيت جالا'], 'postal_code' => '90910'],
            ['gov' => 'PS-BTM', 'name' => ['en' => 'Beit Sahour', 'ar' => 'بيت ساحور'], 'postal_code' => '90920'],
            // Jericho
            ['gov' => 'PS-JCO', 'name' => ['en' => 'Jericho', 'ar' => 'أريحا'], 'postal_code' => '90800'],
            // Salfit
            ['gov' => 'PS-SLT', 'name' => ['en' => 'Salfit', 'ar' => 'سلفيت'], 'postal_code' => '90700'],
            // Tubas
            ['gov' => 'PS-TBS', 'name' => ['en' => 'Tubas', 'ar' => 'طوباس'], 'postal_code' => '90250'],
        ];

        foreach ($palestinianCities as $item) {
            $gov = $palestineGovs->get($item['gov']);
            if (! $gov) {
                continue;
            }

            City::updateOrCreate(
                [
                    'governorate_id' => $gov->id,
                    'postal_code' => $item['postal_code'],
                ],
                [
                    'name' => $item['name'],
                    'is_active' => true,
                ]
            );
        }

        // Global Reference Cities (Inactive)
        $saudiGov = Governorate::where('code', 'SA-01')->first();
        if ($saudiGov) {
            City::updateOrCreate(
                [
                    'governorate_id' => $saudiGov->id,
                    'postal_code' => '11564',
                ],
                [
                    'name' => ['en' => 'Riyadh', 'ar' => 'الرياض'],
                    'is_active' => false,
                ]
            );
        }
    }
}
