<?php

namespace Database\Seeders;

use App\Models\Permiso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permiso::factory()->count(10)->sequence(
            ['nombre' => 'Grupos'],
            ['nombre' => 'Grados'],
            ['nombre' => 'Materias'],
            ['nombre' => 'Alumnos'],
            ['nombre' => 'Docentes'],
            ['nombre' => 'Calificaciones'],
            ['nombre' => 'Asistencias'],
            ['nombre' => 'Actividades'],
            ['nombre' => 'Examenes'],
            ['nombre' => 'Videos'],
        )->create();
    }
}
