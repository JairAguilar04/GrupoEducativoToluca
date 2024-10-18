<?php

namespace Database\Seeders;

use App\Models\TipoUsuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoUsuario::factory()->count(8)->sequence(
            ['nombre' => 'Alumno'],
            ['nombre' => 'Alumno cursos'],
            ['nombre' => 'Docente'],
            ['nombre' => 'Docente cursos'],
            ['nombre' => 'Administrativo'],
            ['nombre' => 'Administrativo cursos'],
            ['nombre' => 'Director'],
            ['nombre' => 'Director cursos'],
        )->create();
    }
}
