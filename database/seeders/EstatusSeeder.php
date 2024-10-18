<?php

namespace Database\Seeders;

use App\Models\Estatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class EstatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Estatus::factory()->count(3)->sequence(
            ['nombre' => 'Activo'],
            ['nombre' => 'Suspendido'],
            ['nombre' => 'Baja'],
        )->create();
    }
}
