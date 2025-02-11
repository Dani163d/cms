<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

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
Route::get('/careers/{career}', [CareerController::class, 'show'])->name('careers.show');

// Rutas de administrador
Route::middleware(['auth', \App\Http\Middleware\EnsureUserIsAdmin::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Dashboard y gestión de usuarios
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/manage-users', [AdminController::class, 'viewUsers'])->name('manageUsers');
        Route::delete('/user/{id}', [AdminController::class, 'deleteUser'])->name('deleteUser');

        // Gestión de carreras
        Route::post('/carreras', [AdminController::class, 'createCareer'])->name('carreras.store');
        Route::get('/carreras/{career}/edit', [AdminController::class, 'editCareer'])->name('carreras.edit');
        Route::put('/carreras/{career}', [AdminController::class, 'updateCareer'])->name('carreras.update');
        Route::delete('/carreras/{career}', [AdminController::class, 'deleteCareer'])->name('carreras.destroy');
    });
require __DIR__.'/auth.php';