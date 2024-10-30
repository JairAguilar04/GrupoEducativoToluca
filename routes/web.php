<?php

use App\Livewire\Cursos\Coordinacion\Alumnos;
use App\Livewire\Cursos\Coordinacion\AlumnosRegistro;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth', 'can:coordinacion-cursos'])->group(function () {
    Route::get('/cursos/alumnos', Alumnos::class)
        ->name('alumnos.cursos');

    Route::get('/cursos/alumnos-registro/{id?}', AlumnosRegistro::class)
        ->name('alumnos.registro');
});


require __DIR__ . '/auth.php';
