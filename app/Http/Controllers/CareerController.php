<?php
// app/Http/Controllers/CareerController.php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function index(Request $request)
    {
        $query = Career::query();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        $careers = $query->paginate(9);

        return view('careers.index', compact('careers'));
    }

    public function branches(Career $career)
    {
        $branches = $career->branches; // Asumiendo que tienes una relación branches en tu modelo Career
        return view('careers.branches', compact('career', 'branches'));
    }
}