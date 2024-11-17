<?php

use App\Livewire\Cursos\Alumnos\Actividades\Actividades;
use App\Livewire\Cursos\Coordinacion\Alumnos;
use App\Livewire\Cursos\Docentes\Actividades\AsignarActividad;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'coordinacion-cursos' => Alumnos::class,
            'coordinacion-alumnos' => Actividades::class,
            'coordinacion-docentes' => AsignarActividad::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
