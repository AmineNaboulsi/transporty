<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\campanys>
 */
class CampanysFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random()->id,
            'description' => fake()->text(),
            'logo' => fake()->imageUrl(),
            'adresse' => fake()->address(),
            'telephone' => fake()->phoneNumber(),
        ];
        // $table->id();
        // $table->foreignId("user_id")->constrained();
        // $table->string('description');
        // $table->string('logo');
        // $table->string('adresse');
        // $table->string('telephone');
        // $table->softDeletes();
        // $table->timestamps();
    }

}
