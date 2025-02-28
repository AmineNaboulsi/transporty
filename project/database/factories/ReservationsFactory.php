<?php

namespace Database\Factories;

use App\Models\navettes;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\reservations>
 */
class ReservationsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "navette_id" => navettes::all()->random()->id,
            "user_id" => User::all()->random()->id,
            "status" => fake()->randomElement(["Pending", "Confirmed"])
        ];
    }
}
