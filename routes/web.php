<?php

use Illuminate\Support\Facades\Route;

// In routes/web.php
Route::get('/', function () {
    return view('welcome');
})->name('home');

// In routes/web.php

Route::get('/noticias', function () {
    return view('noticias');
})->name('noticias.index');
