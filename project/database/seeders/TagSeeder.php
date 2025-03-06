<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Tag::factory()->create([
            "name" => "Wifi",
            "color" => "Red",
        ]);
        Tag::factory()->create([
            "name" => "Air Conditioning",
            "color" => "Yellow"
        ]);
        Tag::factory()->create([
            "name" => "love",
            "color" => "Red",
        ]);
        Tag::factory()->create([
            "name" => "Power Outlets",
            "color" => "Purple",
        ]);
        Tag::factory()->create([
            "name" => "action",
            "color" => "Blue",
        ]);
      
    }
}
