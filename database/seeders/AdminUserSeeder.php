<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
        // Crear el usuario admin si no existe
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'], // Cambia esto por el correo que prefieras
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'), // Clave para el admin
            ]
        );

        // Crear el rol 'admin' si no existe
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Asignar el rol 'admin' al usuario creado
        $admin->assignRole($adminRole);
    }
}
