<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\ArchivoController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\ProyectoFichaController;
use Illuminate\Support\Facades\Auth;

Route::view('/', 'welcome');
Route::post('/contacto', [ContactoController::class, 'store'])->name('contacto.store');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::resource('proyectos', ProyectoController::class)->middleware(['auth']);
Route::post('archivos', [ArchivoController::class, 'store'])->name('archivos.store')->middleware(['auth']);

Route::post('calendario', [CalendarioController::class, 'store'])->name('calendario.store')->middleware(['auth']);
Route::get('calendario', [CalendarioController::class, 'index'])->name('calendario.index')->middleware(['auth']);

Route::get('proyectos/{id}/ficha', [ProyectoFichaController::class, 'show'])->name('proyectos.ficha')->middleware(['auth']);

// Ruta de logout para AdminLTE
Route::post('logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

require __DIR__.'/auth.php';
