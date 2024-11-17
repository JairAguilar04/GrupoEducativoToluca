<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('coordinacion-cursos', function (User $user) {
            return $user->estatus_id == 1 && $user->rol_id == 9;
        });

        Gate::define('coordinacion-alumnos', function (User $user) {
            return $user->estatus_id == 1 && ($user->rol_id == 3 || $user->rol_id == 4);
        });

        Gate::define('coordinacion-docentes', function (User $user) {
            return $user->estatus_id == 1 && ($user->rol_id == 7 || $user->rol_id == 8);
        });
    }
}
