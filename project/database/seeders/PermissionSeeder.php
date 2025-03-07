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
        // $excludedRoutes = ['login', 'register', 'forgetpassword', 'signin', 'signup', 'posts.book', 'posts.index', 'home'];

        // $routes = collect(Route::getRoutes())->filter(function ($route) use ($excludedRoutes) {
        //     return $route->getName() && !in_array($route->getName(), $excludedRoutes);
        // });


        // foreach ($routes as $route) {
        //     Permission::firstOrCreate([
        //         'name' => $route->getName(),
        //         'route' => $route->getName(),
        //     ]);
        // }

        $excludedRoutes = ['login', 'register', 'forgetpassword', 'signin', 'signup', 'posts.book', 'posts.index', 'home','storage.local','logout'];

        $routes = collect(Route::getRoutes())->filter(function ($route) use ($excludedRoutes) {
            return $route->getName() && !in_array($route->getName(), $excludedRoutes);
        });

        // $routes = Route::getRoutes();
        $permissions = [];

        foreach ($routes as $route) {
            if ($name = $route->getName()) {
                $permissions[] = [
                    'name' => $this->generatePermissionName($name),
                    'route' => $name,
                ];
            }
        }

        foreach ($permissions as $perm) {
            Permission::firstOrCreate($perm);
        }
    }

    private function generatePermissionName($routeName)
    {
        // Convert 'roles.create' to 'Create Role'
        $parts = explode('.', $routeName);
        $action = ucfirst(array_pop($parts)); // Last part (create, view, edit)
        $resource = ucfirst(implode(' ', $parts)); // Remaining parts
        $action = strtolower($action) !== 'index' ? $action : 'View';
        return "{$action} {$resource}";
    }
}
