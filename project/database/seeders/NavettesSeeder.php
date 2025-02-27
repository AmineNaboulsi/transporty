<?php

namespace Database\Seeders;

use App\Models\navettes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NavettesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        navettes::factory()->count(100)->create();
    }
}
