<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UserController;
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


require __DIR__ . '/auth.php';


Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UserController::class);
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
