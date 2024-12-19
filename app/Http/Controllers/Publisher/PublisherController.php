<?php

namespace App\Http\Controllers\Publisher;

use App\Http\Controllers\Controller;

class PublisherController extends Controller
{
    public function dashboard()
    {
        return view('publisher.dashboard');
    }
}
