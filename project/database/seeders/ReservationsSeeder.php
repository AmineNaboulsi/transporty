<?php

namespace Database\Seeders;

use App\Models\reservations;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        reservations::factory()->count(20)->create();
    }
}
