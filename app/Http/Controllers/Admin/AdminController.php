<?php
// app/Http/Controllers/Admin/AdminController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Career;
use App\Models\WelcomeSection;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function manageUsers()
    {
        return view('admin.manage-users');
    }

    public function createCareerForm()
    {
        return view('admin.careers.create');
    }

    public function createCareer(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|string',
        ]);

        Career::create([
            'name' => $request->name,
            'description' => $request->description,
            'duration' => $request->duration,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Carrera creada exitosamente');
    }

    public function editCareer($id)
    {
        $career = Career::findOrFail($id);
        return view('admin.edit-career', compact('career'));
    }

    public function updateCareer(Request $request, $id)
    {
        $career = Career::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|string',
        ]);

        $career->update([
            'name' => $request->name,
            'description' => $request->description,
            'duration' => $request->duration,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Carrera actualizada exitosamente');
    }

    public function deleteCareer($id)
    {
        $career = Career::findOrFail($id);
        $career->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Carrera eliminada exitosamente');
    }
}