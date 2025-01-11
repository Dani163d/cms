<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\WelcomeSection;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Mail\NewPublisherCredentials;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
  
    protected $middleware = ['role:admin']; // Solo los administradores pueden acceder


    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function editWelcome()
    {
        $sections = WelcomeSection::all()->keyBy('section_name');
        return view('admin.edit-welcome', compact('sections'));
    }

    // Controlador
    public function updateWelcome(Request $request)
    {
        $validatedData = $request->validate([
            'intro_title' => 'required|string|max:255',
            'intro_content' => 'required|string',
            'intro_span_1' => 'required|string|max:255',
            'intro_span_2' => 'required|string|max:255',
            'about_title' => 'required|string|max:255',
            'about_content' => 'required|string',
            'mission_content' => 'required|string',
            'vision_content' => 'required|string',
        ]);
    
        // Primero, manejar los campos span para la sección intro
        $introSection = WelcomeSection::firstOrCreate(['section_name' => 'intro']);
        
        // Preparar los datos adicionales
        $additionalData = [
            'span_1' => $validatedData['intro_span_1'],
            'span_2' => $validatedData['intro_span_2']
        ];
        
        // Actualizar la sección intro con los datos adicionales
        $introSection->update([
            'title' => $validatedData['intro_title'],
            'content' => $validatedData['intro_content'],
            'additional_data' => json_encode($additionalData)
        ]);
    
        // Actualizar las demás secciones
        WelcomeSection::updateOrCreate(
            ['section_name' => 'about'],
            [
                'title' => $validatedData['about_title'],
                'content' => $validatedData['about_content']
            ]
        );
    
        WelcomeSection::updateOrCreate(
            ['section_name' => 'mission'],
            ['content' => $validatedData['mission_content']]
        );
    
        WelcomeSection::updateOrCreate(
            ['section_name' => 'vision'],
            ['content' => $validatedData['vision_content']]
        );
    
        return redirect()->back()->with('success', 'Contenido actualizado exitosamente');
    }
    // Método para crear un nuevo usuario
    public function createUser(Request $request)
{
    // Validar los datos
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6|confirmed',
    ]);

    // Guardar la contraseña sin encriptar para el correo
    $plainPassword = $request->password;

    // Crear el usuario
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($plainPassword),
    ]);

    // Asignar el rol 'publisher'
    $publisherRole = Role::where('name', 'publisher')->first();
    $user->assignRole($publisherRole);

    // Enviar el correo con las credenciales
    Mail::to($user->email)->send(new NewPublisherCredentials($user->name, $user->email, $plainPassword));

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
