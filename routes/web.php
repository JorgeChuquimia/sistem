<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\http\Controllers\UserController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\NivelController;
use App\Http\Controllers\GradoController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\GestionController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\AsignacionController;
use App\Http\Controllers\AsistenciaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::middleware(['auth'])->group(function () {
    Route::get('/roles', [RolController::class, 'index'])->name('roles.index');
    Route::post('/roles', [RolController::class, 'store'])->name('roles.store');
    Route::put('/roles/{id}', [RolController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{id}', [RolController::class, 'destroy'])->name('roles.destroy');
});
require __DIR__ . '/auth.php';
Route::middleware(['auth'])->group(function () {
    Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');
    Route::post('/usuarios', [UserController::class, 'store'])->name('usuarios.store');
    Route::put('/usuarios/{id}', [UserController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{id}', [UserController::class, 'destroy'])->name('usuarios.destroy');
    Route::resource('personas', PersonaController::class);
    Route::resource('docentes', DocenteController::class);
    Route::resource('niveles', NivelController::class);
    Route::resource('grados', GradoController::class);
    Route::resource('estudiantes', EstudianteController::class);
    Route::resource('gestiones', GestionController::class);
    Route::resource('materias', MateriaController::class);
    Route::resource('asignaciones', AsignacionController::class);
    Route::resource('asistencias', AsistenciaController::class);
});
