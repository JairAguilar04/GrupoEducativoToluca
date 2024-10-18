<?php

namespace Database\Seeders;

use App\Models\HorarioModalidad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HorarioModalidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HorarioModalidad::factory()->count(29)->sequence(
            ['horario_id' => 1, 'modalidad_id' => 1],
            ['horario_id' => 1, 'modalidad_id' => 2],
            ['horario_id' => 1, 'modalidad_id' => 3],

            ['horario_id' => 1, 'modalidad_id' => 5],
            ['horario_id' => 1, 'modalidad_id' => 6],
            ['horario_id' => 1, 'modalidad_id' => 7],

            ['horario_id' => 2, 'modalidad_id' => 5],
            ['horario_id' => 2, 'modalidad_id' => 6],
            ['horario_id' => 2, 'modalidad_id' => 7],

            ['horario_id' => 3, 'modalidad_id' => 8],
            ['horario_id' => 3, 'modalidad_id' => 9],
            ['horario_id' => 3, 'modalidad_id' => 10],
            ['horario_id' => 3, 'modalidad_id' => 11],

            ['horario_id' => 4, 'modalidad_id' => 8],
            ['horario_id' => 4, 'modalidad_id' => 9],
            ['horario_id' => 4, 'modalidad_id' => 10],
            ['horario_id' => 4, 'modalidad_id' => 11],

            ['horario_id' => 5, 'modalidad_id' => 12],
            ['horario_id' => 5, 'modalidad_id' => 13],
            ['horario_id' => 5, 'modalidad_id' => 14],
            ['horario_id' => 5, 'modalidad_id' => 15],
            ['horario_id' => 5, 'modalidad_id' => 16],
            ['horario_id' => 5, 'modalidad_id' => 17],

            ['horario_id' => 6, 'modalidad_id' => 12],
            ['horario_id' => 6, 'modalidad_id' => 13],
            ['horario_id' => 6, 'modalidad_id' => 14],
            ['horario_id' => 6, 'modalidad_id' => 15],
            ['horario_id' => 6, 'modalidad_id' => 16],
            ['horario_id' => 6, 'modalidad_id' => 17],

        )->create();
    }
}
