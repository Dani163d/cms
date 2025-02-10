<?php
// database/seeders/RolesAndPermissionsSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Crear permisos para la gestión de carreras
        $permissions = [
            'create careers',
            'edit careers',
            'delete careers',
            'view careers',
            'manage users'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Crear roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Asignar todos los permisos al rol 'admin'
        $adminRole->syncPermissions([
            'create careers', 
            'edit careers', 
            'delete careers', 
            'view careers', 
            'manage users',
        ]);

        // Asignar solo el permiso de ver carreras al rol 'user'
        $userRole->syncPermissions([
            'view careers',
        ]);
    }
}