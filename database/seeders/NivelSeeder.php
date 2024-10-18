<?php

namespace Database\Seeders;

use App\Models\Nivel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NivelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Nivel::factory()->count(5)->sequence(
            ['nombre' => 'Preparatoria'],
            ['nombre' => 'Licenciatura'],
            ['nombre' => 'Cursos preparatoria'],
            ['nombre' => 'Cursos licenciatura'],
            ['nombre' => 'Cursos licenciatura (2da etapa)'],
        )->create();
    }
}
