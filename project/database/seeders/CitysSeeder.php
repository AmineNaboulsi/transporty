<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
           ['name' => 'Fes', 'region' => 'Fès-Meknès', 'latitude' => 34.0331, 'longitude' => -5.0003],
            ['name' => 'Tangier', 'region' => 'Tanger-Tétouan-Al Hoceïma', 'latitude' => 35.7595, 'longitude' => -5.83395],
            ['name' => 'Agadir', 'region' => 'Souss-Massa', 'latitude' => 30.4278, 'longitude' => -9.5981],
            ['name' => 'Meknes', 'region' => 'Fès-Meknès', 'latitude' => 33.8955, 'longitude' => -5.5541],
            ['name' => 'Oujda', 'region' => 'Oriental', 'latitude' => 34.6805, 'longitude' => -1.8989],
            ['name' => 'Kenitra', 'region' => 'Rabat-Salé-Kénitra', 'latitude' => 34.261, 'longitude' => -6.5802],
            ['name' => 'Tetouan', 'region' => 'Tanger-Tétouan-Al Hoceïma', 'latitude' => 35.5785, 'longitude' => -5.3684],
            ['name' => 'Safi', 'region' => 'Marrakech-Safi', 'latitude' => 32.2833, 'longitude' => -9.2333],
            ['name' => 'El Jadida', 'region' => 'Casablanca-Settat', 'latitude' => 33.2312, 'longitude' => -8.5007],
            ['name' => 'Beni Mellal', 'region' => 'Béni Mellal-Khénifra', 'latitude' => 32.3394, 'longitude' => -6.3623],
            ['name' => 'Nador', 'region' => 'Oriental', 'latitude' => 35.1681, 'longitude' => -2.9335],
            ['name' => 'Taza', 'region' => 'Fès-Meknès', 'latitude' => 34.2167, 'longitude' => -3.6833],
            ['name' => 'Settat', 'region' => 'Casablanca-Settat', 'latitude' => 33.001, 'longitude' => -7.6188],
            ['name' => 'Laayoune', 'region' => 'Laâyoune-Sakia El Hamra', 'latitude' => 27.1536, 'longitude' => -13.2033],
            ['name' => 'Guelmim', 'region' => 'Guelmim-Oued Noun', 'latitude' => 28.9884, 'longitude' => -10.0574],
            ['name' => 'Errachidia', 'region' => 'Drâa-Tafilalet', 'latitude' => 31.9314, 'longitude' => -4.4244],
            ['name' => 'Taroudant', 'region' => 'Souss-Massa', 'latitude' => 30.4724, 'longitude' => -8.8822],
            ['name' => 'Tiznit', 'region' => 'Souss-Massa', 'latitude' => 29.6974, 'longitude' => -9.7316],
            ['name' => 'Dakhla', 'region' => 'Dakhla-Oued Ed-Dahab', 'latitude' => 23.6848, 'longitude' => -15.957],
            ['name' => 'Azilal', 'region' => 'Béni Mellal-Khénifra', 'latitude' => 31.963, 'longitude' => -6.5706],
            ['name' => 'Sidi Ifni', 'region' => 'Guelmim-Oued Noun', 'latitude' => 29.3791, 'longitude' => -10.1725],
            ['name' => 'Khenifra', 'region' => 'Béni Mellal-Khénifra', 'latitude' => 32.9394, 'longitude' => -5.6693],
            ['name' => 'Ouarzazate', 'region' => 'Drâa-Tafilalet', 'latitude' => 30.9189, 'longitude' => -6.8937]
        ];

        DB::table('citys')->insert($cities);
    }

}
