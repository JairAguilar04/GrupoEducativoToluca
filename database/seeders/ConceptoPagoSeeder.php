<?php

namespace Database\Seeders;

use App\Models\ConceptoPago;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConceptoPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ConceptoPago::factory()->count(7)->sequence(
            ['nombre' => 'Inscripción'],
            ['nombre' => 'Reinscripción'],
            ['nombre' => 'Colegiatura'],
            ['nombre' => 'Uniforme'],
            ['nombre' => 'Credencial'],
            ['nombre' => 'Libros'],
            ['nombre' => 'Cuadernillos'],
        )->create();
    }
}
