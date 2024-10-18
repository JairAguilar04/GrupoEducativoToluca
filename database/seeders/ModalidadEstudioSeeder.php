<?php

namespace Database\Seeders;

use App\Models\ModalidadEstudio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModalidadEstudioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModalidadEstudio::factory()->count(17)->sequence(
            ['nivel_id' => 1, 'nombre' => 'Preparatoria por asignaturas', 'duracion' => '2 años'],
            ['nivel_id' => 1, 'nombre' => 'Programa de emprendimiento', 'duracion' => '2 años'],
            ['nivel_id' => 1, 'nombre' => 'Formación integral', 'duracion' => '2 años'],
            ['nivel_id' => 1, 'nombre' => 'Otros'],

            ['nivel_id' => 2, 'nombre' => 'Derecho', 'duracion' => '3 años'],
            ['nivel_id' => 2, 'nombre' => 'Administración', 'duracion' => '3 años'],
            ['nivel_id' => 2, 'nombre' => 'Pedagogía', 'duracion' => '3 años'],

            ['nivel_id' => 3, 'nombre' => 'Pensamiento matemático', 'duracion' => '10 semanas'],
            ['nivel_id' => 3, 'nombre' => 'Pensamiento científico', 'duracion' => '10 semanas'],
            ['nivel_id' => 3, 'nombre' => 'Comprensión lectora', 'duracion' => '10 semanas'],
            ['nivel_id' => 3, 'nombre' => 'Redacción indirecta', 'duracion' => '10 semanas'],

            ['nivel_id' => 4, 'nombre' => 'Pensamiento matemático', 'duracion' => '20 semanas'],
            ['nivel_id' => 4, 'nombre' => 'Pensamiento científico', 'duracion' => '20 semanas'],
            ['nivel_id' => 4, 'nombre' => 'Comprensión lectora', 'duracion' => '20 semanas'],
            ['nivel_id' => 4, 'nombre' => 'Redacción indirecta', 'duracion' => '20 semanas'],
            ['nivel_id' => 4, 'nombre' => 'Módulo 1', 'duracion' => '20 semanas'],
            ['nivel_id' => 4, 'nombre' => 'Módulo 2', 'duracion' => '20 semanas'],
        )->create();
    }
}
