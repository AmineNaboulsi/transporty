<?php

namespace Database\Factories;

use App\Models\campanys;
use App\Models\citys;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\navettes>
 */
class NavettesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "campany_id" => campanys::all()->random()->id ,
            "nom" => fake()->name(),
            "description" => fake()->text(),
            "type_vehicule" => fake()->text(20),
            "price" => fake()->randomFloat(0,20,500),
            "date_navette" => fake()->dateTimeBetween('now', '+1 day')->format('Y-m-d'),
            "places_disponible" => fake()->numberBetween(10, 100),
            "city_start" => citys::all()->random()->id ,
            "city_arrive" => citys::all()->random()->id,
            "time_start" => fake()->time(),
            "time_end" => fake()->time()
        ];
    }
}
