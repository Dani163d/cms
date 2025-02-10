<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class, // Primero crear roles y permisos
            AdminUserSeeder::class,           // Luego crear el admin y asignar roles
        ]);
    }
}