<?php

namespace Database\Seeders;

use App\Models\Pago;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pago::factory()->count(25)->sequence(
            //preparatoria
            ['nivel_id' => 1, 'concepto_id' => 1, 'periodo_id' => 1, 'monto_unitario' => 1000],
            ['nivel_id' => 1, 'concepto_id' => 2, 'periodo_id' => 2, 'monto_unitario' => 1000],
            ['nivel_id' => 1, 'concepto_id' => 3, 'periodo_id' => 3, 'monto_unitario' => 1000],
            ['nivel_id' => 1, 'concepto_id' => 3, 'periodo_id' => 4, 'monto_unitario' => 1000],
            ['nivel_id' => 1, 'concepto_id' => 4, 'periodo_id' => 1, 'monto_unitario' => 1000],
            ['nivel_id' => 1, 'concepto_id' => 5, 'periodo_id' => 2, 'monto_unitario' => 1000],
            ['nivel_id' => 1, 'concepto_id' => 6, 'periodo_id' => 5, 'monto_unitario' => 1000],
            ['nivel_id' => 1, 'concepto_id' => 7, 'periodo_id' => 6, 'monto_unitario' => 1000],

            //licenciatura
            ['nivel_id' => 2, 'concepto_id' => 1, 'periodo_id' => 1, 'monto_unitario' => 2000],
            ['nivel_id' => 2, 'concepto_id' => 2, 'periodo_id' => 2, 'monto_unitario' => 2000],
            ['nivel_id' => 2, 'concepto_id' => 3, 'periodo_id' => 3, 'monto_unitario' => 2000],
            ['nivel_id' => 2, 'concepto_id' => 3, 'periodo_id' => 4, 'monto_unitario' => 2000],
            ['nivel_id' => 2, 'concepto_id' => 5, 'periodo_id' => 2, 'monto_unitario' => 2000],
            ['nivel_id' => 2, 'concepto_id' => 6, 'monto_unitario' => 2000],
            ['nivel_id' => 2, 'concepto_id' => 7, 'monto_unitario' => 2000],


            //cursos preparatoria
            ['nivel_id' => 3, 'concepto_id' => 1, 'periodo_id' => 1, 'monto_unitario' => 3000],
            ['nivel_id' => 3, 'concepto_id' => 3, 'periodo_id' => 3, 'monto_unitario' => 500.23],
            ['nivel_id' => 3, 'concepto_id' => 3, 'periodo_id' => 4, 'monto_unitario' => 2000.93],
            ['nivel_id' => 3, 'concepto_id' => 5, 'periodo_id' => 2, 'monto_unitario' => 3000],
            ['nivel_id' => 3, 'concepto_id' => 7, 'periodo_id' => 7, 'monto_unitario' => 3000.233],


            //cursos licenciatura
            ['nivel_id' => 4, 'concepto_id' => 1, 'periodo_id' => 1, 'monto_unitario' => 100.202050],
            ['nivel_id' => 4, 'concepto_id' => 3, 'periodo_id' => 3, 'monto_unitario' => 700.58],
            ['nivel_id' => 4, 'concepto_id' => 3, 'periodo_id' => 4, 'monto_unitario' => 2800.28],
            ['nivel_id' => 4, 'concepto_id' => 5, 'periodo_id' => 2, 'monto_unitario' => 100.2020500],
            ['nivel_id' => 4, 'concepto_id' => 7, 'periodo_id' => 8, 'monto_unitario' => 100.2020500],

        )->create();
    }
}
