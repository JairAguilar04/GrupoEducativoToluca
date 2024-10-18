<?php

namespace Database\Seeders;

use App\Models\Horario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HorarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Horario::factory()->count(6)->sequence(
            ['dia' => 'Lunes a viernes', 'horario' => '09:00 a.m. - 02:00 p.m.'],
            ['dia' => 'Sabado', 'horario' => '09:00 a.m. - 02:00 p.m.'],

            ['dia' => 'Sabado', 'horario' => '07:00 a.m. - 01:00 p.m.'],
            ['dia' => 'Sabado', 'horario' => '01:30 p.m. - 07:30 p.m.'],

            ['dia' => 'Sabado', 'horario' => '08:00 a.m. - 02:00 p.m.'],
            ['dia' => 'Sabado', 'horario' => '02:30 p.m. - 07:30 p.m.'],

        )->create();
    }
}
