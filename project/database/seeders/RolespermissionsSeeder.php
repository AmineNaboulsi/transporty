<?php

namespace Database\Seeders;

use App\Models\permission;
use App\Models\roles;
use App\Models\rolespermissions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolespermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'admin',
            'client',
            'company',
            'viewer'
        ];

        foreach ($roles as $roleName) {
            $role = roles::firstOrCreate(['name' => $roleName]);

            $permissions = Permission::all();

            if ($role->name == 'admin') {
                $role->permissions()->sync($permissions->pluck('id')->toArray());
            }
            if ($role->name == 'client') {
                $role->permissions()->sync($permissions->whereIn('route',
                ['home', 'profile.index','posts.book','booking.reservation','booking.index',
                'profile.reservations','profile.favorite','profile.payment',
                'profile.notification','profile.password','profile.edit','cancel.navette','booking.cancel'
                ])->pluck('id')->toArray());
            }
            if ($role->name == 'company') {
                $role->permissions()->sync($permissions->whereIn('route',
                ['home', 'dashboard.index',
                'navettes.index','navettes.create','navettes.store',
                ])->pluck('id')->toArray());
            }
            if ($role->name == 'viewer') {
                $role->permissions()->sync($permissions->whereIn('route', ['home', 'profile.index'])->pluck('id')->toArray());
            }
        }
    }
}
