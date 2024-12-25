<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/noticias', function () {
    return view('noticias');
})->name('noticias.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

// Authentication Routes
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store']);

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');
    

    use App\Http\Controllers\Admin\AdminController;
    Route::middleware(['auth', \App\Http\Middleware\EnsureUserIsAdmin::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/manage-users', [AdminController::class, 'viewUsers'])->name('manageUsers');
        Route::delete('/user/{id}', [AdminController::class, 'deleteUser'])->name('deleteUser');
        Route::post('/user/{id}/role/{role}', [AdminController::class, 'changeRole'])->name('changeRole');
    });

    
    
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::post('/admin/create-user', [AdminController::class, 'createUser'])->name('admin.createUser');



    

use App\Http\Controllers\Publisher\PublisherController;

Route::middleware(['auth', \App\Http\Middleware\EnsureUserIsPublisher::class])
    ->prefix('publisher')
    ->name('publisher.')
    ->group(function () {
        Route::get('/dashboard', [PublisherController::class, 'dashboard'])->name('dashboard');
        Route::post('/dashboard', [PublisherController::class, 'storeNews'])->name('storeNews');
        Route::get('edit/{id}', [PublisherController::class, 'editNews'])->name('editNews');
        Route::post('update/{id}', [PublisherController::class, 'updateNews'])->name('updateNews');
        Route::delete('delete/{id}', [PublisherController::class, 'deleteNews'])->name('deleteNews');
    });



// Ruta para mostrar las noticias
Route::get('/noticias', [PublisherController::class, 'showNews'])->name('noticias');

Route::post('/upload-image', [PublisherController::class, 'uploadImage'])
    ->name('upload.image')
    ->middleware(['auth', 'web']);