<?php

namespace Database\Seeders;

use App\Models\Rol;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Rol::factory()->count(10)->sequence(
            ['tipo_id' => 1, 'nombre' => 'Alumno preparatoria', 'nombre_url' => 'alumno.preparatoria', 'estatus' => 1,],
            ['tipo_id' => 1, 'nombre' => 'Alumno licenciatura', 'nombre_url' => 'alumno.licenciatura', 'estatus' => 1,],
            ['tipo_id' => 2, 'nombre' => 'Alumno cursos preparatoria', 'nombre_url' => 'alumno.cursos.preparatoria', 'estatus' => 1,],
            ['tipo_id' => 2, 'nombre' => 'Alumno cursos licenciatura', 'nombre_url' => '/cursos/alumnos', 'estatus' => 1,],

            ['tipo_id' => 3, 'nombre' => 'Docente preparatoria', 'nombre_url' => 'docente.preparatoria', 'estatus' => 1,],
            ['tipo_id' => 3, 'nombre' => 'Docente licenciatura', 'nombre_url' => 'docente.licenciatura', 'estatus' => 1,],
            ['tipo_id' => 4, 'nombre' => 'Docente cursos preparatoria', 'nombre_url' => 'docente.cursos.preparatoria', 'estatus' => 1,],
            ['tipo_id' => 4, 'nombre' => 'Docente cursos licenciatura', 'nombre_url' => 'docente.cursos.licenciatura', 'estatus' => 1,],

            ['tipo_id' => 6, 'nombre' => 'Coordinación de cursos', 'nombre_url' => '/cursos/alumnos', 'estatus' => 1,],
            ['tipo_id' => 8, 'nombre' => 'Coordinación central', 'nombre_url' => 'coordinación.central', 'estatus' => 1,],
        )->create();
    }
}
