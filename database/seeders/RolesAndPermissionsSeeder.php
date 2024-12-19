<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Crear permisos (usando firstOrCreate)
        $permissions = [
            'create articles',
            'edit articles',
            'delete articles',
            'view articles',
            'manage users'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Crear roles (usando firstOrCreate)
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $publisherRole = Role::firstOrCreate(['name' => 'publisher']);
        $visitorRole = Role::firstOrCreate(['name' => 'visitor']);

        // Asignar permisos al rol 'admin'
        $adminRole->syncPermissions([
            'create articles', 
            'edit articles', 
            'delete articles', 
            'view articles', 
            'manage users',
        ]);

        // Asignar permisos al rol 'publisher'
        $publisherRole->syncPermissions([
            'create articles', 
            'edit articles', 
            'view articles',
        ]);

        // Asignar permisos al rol 'visitor'
        $visitorRole->syncPermissions([
            'view articles',
        ]);
    }
}
