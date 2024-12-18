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
        $permission1 = Permission::firstOrCreate(['name' => 'create articles']);
        $permission2 = Permission::firstOrCreate(['name' => 'edit articles']);
        $permission3 = Permission::firstOrCreate(['name' => 'delete articles']);
        $permission4 = Permission::firstOrCreate(['name' => 'view articles']);
        $permission5 = Permission::firstOrCreate(['name' => 'manage users']);

        // Crear roles (usando firstOrCreate)
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $publisherRole = Role::firstOrCreate(['name' => 'publisher']);
        $visitorRole = Role::firstOrCreate(['name' => 'visitor']);

        // Asignar permisos al rol 'admin'
        $adminRole->syncPermissions([
            $permission1, 
            $permission2, 
            $permission3, 
            $permission4, 
            $permission5
        ]);

        // Asignar permisos al rol 'publisher'
        $publisherRole->syncPermissions([
            $permission1, 
            $permission2, 
            $permission4
        ]);

        // Asignar permisos al rol 'visitor'
        $visitorRole->syncPermissions([$permission4]);
    }
}