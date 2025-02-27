<?php

namespace Database\Seeders;

use App\Models\campanys;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CampanysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        campanys::factory()->count(8)->create();
    }
}
