<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
  
    protected $middleware = ['role:admin']; // Solo los administradores pueden acceder


    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // Método para crear un nuevo usuario
    public function createUser(Request $request)
    {
        // Validar los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed', // Confirmación de contraseña
        ]);

        // Crear el usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Asignar el rol 'publisher' al nuevo usuario
        $publisherRole = Role::where('name', 'publisher')->first();
        $user->assignRole($publisherRole);

        // Redirigir con un mensaje de éxito
        return redirect()->route('admin.dashboard')->with('success', 'Usuario registrado como publicador exitosamente');
    }
}
