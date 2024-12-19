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

    public function viewUsers()
    {
        // Obtener los roles 'publisher' y 'visitor'
        $publisherRole = Role::where('name', 'publisher')->first();
        $visitorRole = Role::where('name', 'visitor')->first();

        // Obtener los usuarios con el rol de 'publisher' y 'visitor'
        $publishers = User::role('publisher')->get();
        $visitors = User::role('visitor')->get();

        // Pasar los datos a la vista 'admin.manage_user'
        return view('admin.manage_users', compact('publishers', 'visitors'));
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        // Eliminar usuario
        $user->delete();

        // Redirigir con mensaje de éxito
        return redirect()->route('admin.manageUsers')->with('success', 'Usuario eliminado exitosamente');
    }

    public function changeRole($id, $role)
    {
        $user = User::findOrFail($id);

        // Validar que el rol proporcionado sea 'publisher' o 'visitor'
        if (!in_array($role, ['publisher', 'visitor'])) {
            return redirect()->route('admin.manageUsers')->with('error', 'Rol inválido');
        }

        // Eliminar los roles actuales y asignar el nuevo rol
        $user->syncRoles([$role]);

        // Redirigir con mensaje de éxito
        return redirect()->route('admin.manageUsers')->with('success', 'Rol cambiado exitosamente');
    }

}
