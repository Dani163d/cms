<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Models\Career;

// Ruta principal redirige al login
Route::redirect('/', '/login');

// Rutas de autenticación
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Rutas públicas de carreras
Route::get('/careers', [CareerController::class, 'index'])->name('careers.index');
Route::get('/careers/{career}/branches', [CareerController::class, 'branches'])->name('careers.branches');

// Rutas de administrador
Route::middleware(['auth', \App\Http\Middleware\EnsureUserIsAdmin::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Dashboard y gestión de usuarios
        Route::get('/manage-users', [AdminController::class, 'viewUsers'])->name('manageUsers');
        Route::get('/edit-welcome', [AdminController::class, 'editWelcome'])->name('editWelcome');
        Route::post('/edit-welcome/career', [AdminController::class, 'createCareer'])->name('createCareer');
        Route::put('/edit-welcome/career/{career}', [AdminController::class, 'updateWelcome'])->name('updateWelcome');
        Route::delete('/edit-welcome/career/{career}', [AdminController::class, 'deleteCareer'])->name('deleteCareer');
        Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('deleteUser');
        // routes/web.php

        Route::get('/admin/careers/{career}', function (Career $career) {
        return response()->json($career);
    })->name('admin.getCareer');
    });
    Route::get('/admin/careers/{career}', [AdminController::class, 'getCareer'])->name('admin.getCareer');
require __DIR__.'/auth.php';