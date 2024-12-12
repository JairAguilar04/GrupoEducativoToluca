<?php

use App\Livewire\Cursos\Alumnos\Actividades\Actividades;
use App\Livewire\Cursos\Coordinacion\Alumnos;
use App\Livewire\Cursos\Coordinacion\AlumnosRegistro;
use App\Livewire\Cursos\Coordinacion\Docentes\Docentes;
use App\Livewire\Cursos\Coordinacion\Docentes\DocentesRegistro;
use App\Livewire\Cursos\Coordinacion\Grados\Grados;
use App\Livewire\Cursos\Coordinacion\Grupos\Grupos;
use App\Livewire\Cursos\Coordinacion\Grupos\GruposRegistro;
use App\Livewire\Cursos\Coordinacion\Materias\Materias;
use App\Livewire\Cursos\Docentes\Actividades\AsignarActividad;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth', 'can:coordinacion-cursos'])->group(function () {
    //alumnos
    Route::get('/cursos/alumnos', Alumnos::class)
        ->name('alumnos.cursos');

    Route::get('/cursos/alumnos-registro/{id?}', AlumnosRegistro::class)
        ->name('alumnos.registro');

    //docentes
    Route::get('/cursos/docentes', Docentes::class)
        ->name('cursos.docentes');

    Route::get('/cursos/docente-registro/{id?}', DocentesRegistro::class)
        ->name('cursos.docentes.registro');

    //materias
    Route::get('/cursos/materias', Materias::class)
        ->name('cursos.materias');

    //grados
    Route::get('/cursos/grados-academicos', Grados::class)
        ->name('cursos.grados');

    //grupos
    Route::get('/cursos/grupos', Grupos::class)
        ->name('cursos.grupos');

    Route::get('/cursos/grupos-registro', GruposRegistro::class)
        ->name('cursos.grupos.registro');
});

Route::middleware(['auth', 'can:coordinacion-alumnos'])->group(function () {

    Route::get('/cursos/alumnos-actividades', Actividades::class)
        ->name('cursos.alumnos.actividades');
});

Route::middleware(['auth', 'can:coordinacion-docentes'])->group(function () {

    Route::get('/cursos/docentes/asignar-actividades', AsignarActividad::class)
        ->name('cursos.docentes.actividades');
});

require __DIR__ . '/auth.php';
