<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Career;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $careers = Career::latest()->get();
        return view('admin.dashboard', compact('careers'));
    }

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

    public function createCareer(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|integer|min:1',
            'area' => 'required|string'
        ]);

        Career::create($validated);
        return redirect()->back()->with('success', 'Carrera creada exitosamente');
    }

    public function editCareer(Career $career)
    {
        return view('admin.careers.edit', compact('career'));
    }

    public function updateCareer(Request $request, Career $career)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|integer|min:1',
            'area' => 'required|string'
        ]);

        $career->update($validated);
        return redirect()->route('admin.dashboard')->with('success', 'Carrera actualizada exitosamente');
    }

    public function deleteCareer(Career $career)
    {
        $career->delete();
        return redirect()->back()->with('success', 'Carrera eliminada exitosamente');
    }
}