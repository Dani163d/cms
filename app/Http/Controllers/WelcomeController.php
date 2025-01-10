<?php

namespace App\Http\Controllers;

use App\Models\WelcomeSection;

class WelcomeController extends Controller
{
    public function index()
    {
        $sections = WelcomeSection::all()->keyBy('section_name');
        return view('welcome', compact('sections'));
    }
}