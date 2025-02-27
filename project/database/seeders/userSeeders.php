<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class userSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 1
        ]);

        User::create([
            'name' => 'Editor User',
            'email' => 'coampany1@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 2
        ]);

        User::create([
            'name' => 'Viewer User',
            'email' => 'client@gmail.com',
            'password' => bcrypt('password'),
            'role_id' => 3
        ]);
    }
}
