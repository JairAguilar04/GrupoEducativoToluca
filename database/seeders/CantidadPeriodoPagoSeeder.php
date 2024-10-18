<?php

namespace Database\Seeders;

use App\Models\CantidadPeriodoPago;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CantidadPeriodoPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CantidadPeriodoPago::factory()->count(8)->sequence(
            ['nombre' => 'Único'],
            ['nombre' => 'Anual'],
            ['nombre' => 'Semanal'],
            ['nombre' => 'Mensual'],
            ['nombre' => '3'],
            ['nombre' => '33'],
            ['nombre' => '4'],
            ['nombre' => '6'],
        )->create();
    }
}
