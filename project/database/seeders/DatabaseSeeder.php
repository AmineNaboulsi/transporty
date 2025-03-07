<?php

namespace Database\Seeders;

use App\Models\campanys;
use App\Models\roles;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin User',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'role_id' => roles::where('name','=','admin')->first()->id,
        ]);
        $Usercompany = User::factory()->create([
            'name' => 'company User',
            'email' => 'company@gmail.com',
            'password' => bcrypt('company'),
            'role_id' => roles::where('name','=','company')->first()->id,
        ]);
        campanys::create([
            'user_id' => $Usercompany->id,
        ]);
        User::factory()->create([
            'name' => 'client User',
            'email' => 'client@gmail.com',
            'password' => bcrypt('client'),
            'role_id' => roles::where('name','=','client')->first()->id,
        ]);
    }
}
