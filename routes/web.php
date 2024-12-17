<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// In routes/web.php

Route::get('/noticias', function () {
    return view('noticias');
})->name('noticias.index');
