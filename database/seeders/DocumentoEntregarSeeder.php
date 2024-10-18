<?php

namespace Database\Seeders;

use App\Models\DocumentoEntregar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentoEntregarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DocumentoEntregar::factory()->count(8)->sequence(
            ['rol_id' => 1, 'nombre' => 'Acta de nacimiento'],
            ['rol_id' => 1, 'nombre' => 'Certificado de secundaria'],
            ['rol_id' => 1, 'nombre' => 'CURP'],
            ['rol_id' => 1, 'nombre' => 'Copia de identificación oficial (INE)'],
            ['rol_id' => 1, 'nombre' => 'Comprobante de domicilio'],
            ['rol_id' => 1, 'nombre' => 'Certificado médico'],
            ['rol_id' => 1, 'nombre' => '4 fotografías tamaño infantil B/N'],
            ['rol_id' => 1, 'nombre' => '2 fotografías tamaño infantil C/R'],
        )->create();
    }
}
