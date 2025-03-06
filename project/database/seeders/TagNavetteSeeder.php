<?php

namespace Database\Seeders;

use App\Models\NavetteTags;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Navettes;
use App\Models\Tag;

class TagNavetteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        NavetteTags::create([
            "tag_id" =>  Tag::all()->random()->id,
            "navette_id" => Navettes::all()->random()->id,
        ]);
    }
}
