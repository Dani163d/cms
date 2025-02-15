<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Career;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function viewUsers()
    {
        $users = User::where('id', '!=', auth()->id())->get();
        return view('admin.manage-users', compact('users'));
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        if (!$user->hasRole('admin')) {
            $user->delete();
            return redirect()->back()->with('success', 'Usuario eliminado exitosamente');
        }
        return redirect()->back()->with('error', 'No se puede eliminar un administrador');
    }

    public function editWelcome()
    {
        $careers = Career::with('user')->latest()->get();
        return view('admin.edit-welcome', compact('careers'));
    }
    public function getCareer(Career $career)
{
    return response()->json($career);
}

    public function createCareer(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|integer|min:1',
        ]);

        $validated['user_id'] = auth()->id();

        Career::create($validated);
        return redirect()->back()->with('success', 'Carrera creada exitosamente');
    }

    public function updateWelcome(Request $request, Career $career)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|integer|min:1',
        ]);

        $career->update($validated);
        return redirect()->back()->with('success', 'Carrera actualizada exitosamente');
    }

    public function deleteCareer(Career $career)
    {
        $career->delete();
        return redirect()->back()->with('success', 'Carrera eliminada exitosamente');
    }
}