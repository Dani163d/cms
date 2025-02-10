<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

// Ruta principal
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Rutas públicas de carreras
Route::get('/careers', [CareerController::class, 'index'])->name('careers.index');
Route::get('/careers/{career}', [CareerController::class, 'show'])->name('careers.show');

// Rutas de autenticación
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Rutas protegidas por autenticación
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rutas de perfil
    Route::middleware(['auth'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

// Rutas de administrador
Route::middleware(['auth', \App\Http\Middleware\EnsureUserIsAdmin::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Dashboard y gestión de usuarios
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/manage-users', [AdminController::class, 'viewUsers'])->name('manageUsers');
        Route::delete('/user/{id}', [AdminController::class, 'deleteUser'])->name('deleteUser');

        // Gestión de contenido de bienvenida
        Route::get('/edit-welcome', [AdminController::class, 'editWelcome'])->name('edit-welcome');
        Route::put('/update-welcome', [AdminController::class, 'updateWelcome'])->name('update-welcome');

        // Gestión de carreras
        Route::get('/carreras/crear', [AdminController::class, 'createCareerForm'])->name('carreras.create');
        Route::post('/carreras', [AdminController::class, 'createCareer'])->name('carreras.store');
        Route::get('/carreras/{career}/edit', [AdminController::class, 'editCareer'])->name('carreras.edit');
        Route::put('/carreras/{career}', [AdminController::class, 'updateCareer'])->name('carreras.update');
        Route::delete('/carreras/{career}', [AdminController::class, 'deleteCareer'])->name('carreras.destroy');
    });

// Ruta de contacto
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


Route::resource('careers', CareerController::class);

require __DIR__.'/auth.php';