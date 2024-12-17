<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Crear permisos
        $permission1 = Permission::create(['name' => 'create articles']);  // Crear artículos
        $permission2 = Permission::create(['name' => 'edit articles']);    // Editar artículos
        $permission3 = Permission::create(['name' => 'delete articles']);  // Eliminar artículos
        $permission4 = Permission::create(['name' => 'view articles']);    // Ver artículos
        $permission5 = Permission::create(['name' => 'manage users']);     // Gestionar usuarios

        // Crear roles
        $adminRole = Role::create(['name' => 'admin']);
        $publisherRole = Role::create(['name' => 'publisher']);
        $visitorRole = Role::create(['name' => 'visitor']);

        // Asignar permisos al rol 'admin' (todos los permisos)
        $adminRole->givePermissionTo([
            $permission1, // Crear artículos
            $permission2, // Editar artículos
            $permission3, // Eliminar artículos
            $permission4, // Ver artículos
            $permission5  // Gestionar usuarios
        ]);

        // Asignar permisos al rol 'publisher' (crear, editar y ver artículos)
        $publisherRole->givePermissionTo([
            $permission1, // Crear artículos
            $permission2, // Editar artículos
            $permission4  // Ver artículos
        ]);

        // Asignar permisos al rol 'visitor' (solo ver artículos)
        $visitorRole->givePermissionTo($permission4); // Ver artículos
    }
}
