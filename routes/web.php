<?php

use App\Livewire\Cursos\Coordinacion\Alumnos;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth', 'can:coordinacion-cursos'])->group(function () {
    Route::get('/alumnos-cursos', Alumnos::class)
        ->name('alumnos.cursos');
});


require __DIR__ . '/auth.php';
