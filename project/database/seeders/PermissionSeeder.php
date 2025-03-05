<?php

namespace Database\Seeders;

use App\Models\permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $routes = Route::getRoutes();

        foreach ($routes as $route) {
            $name = $route->getName();
            $methods = $route->methods();

            if ($name) {
                foreach ($methods as $method) {
                    $method !== 'HEAD' &&
                    Permission::firstOrCreate([
                        'name' => "{$name}_{$method}",
                        'route' => $name,
                        'method' => $method,
                    ]);
                }
            }
        }

        // $permissions = [
        //     //User
        //     'view_users',
        //     'create_users',
        //     'edit_users',
        //     'delete_users',
        //     //Navette
        //     'view_navette',
        //     'create_navette',
        //     'edit_navette',
        //     'delete_navette',
        //     //
        //     'make_reservation',
        // ];

        // foreach ($permissions as $permission) {
        //     permission::create(['name' => $permission]);
        // }
    }
}
