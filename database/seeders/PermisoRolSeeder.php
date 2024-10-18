<?php

namespace Database\Seeders;

use App\Models\PermisoRol;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermisoRolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PermisoRol::factory()->count(39)->sequence(
            ['permiso_id' => 6, 'rol_id' => 1],
            ['permiso_id' => 7, 'rol_id' => 1],
            ['permiso_id' => 8, 'rol_id' => 1],
            ['permiso_id' => 9, 'rol_id' => 1],

            ['permiso_id' => 6, 'rol_id' => 2],
            ['permiso_id' => 7, 'rol_id' => 2],
            ['permiso_id' => 8, 'rol_id' => 2],
            ['permiso_id' => 9, 'rol_id' => 2],

            ['permiso_id' => 6, 'rol_id' => 3],
            ['permiso_id' => 7, 'rol_id' => 3],
            ['permiso_id' => 8, 'rol_id' => 3],
            ['permiso_id' => 9, 'rol_id' => 3],
            ['permiso_id' => 10, 'rol_id' => 3],

            ['permiso_id' => 6, 'rol_id' => 4],
            ['permiso_id' => 7, 'rol_id' => 4],
            ['permiso_id' => 8, 'rol_id' => 4],
            ['permiso_id' => 9, 'rol_id' => 4],
            ['permiso_id' => 10, 'rol_id' => 4],

            ['permiso_id' => 8, 'rol_id' => 5],
            ['permiso_id' => 9, 'rol_id' => 5],
            ['permiso_id' => 7, 'rol_id' => 5],

            ['permiso_id' => 8, 'rol_id' => 6],
            ['permiso_id' => 9, 'rol_id' => 6],
            ['permiso_id' => 7, 'rol_id' => 6],

            ['permiso_id' => 8, 'rol_id' => 7],
            ['permiso_id' => 9, 'rol_id' => 7],
            ['permiso_id' => 10, 'rol_id' => 7],
            ['permiso_id' => 7, 'rol_id' => 7],

            ['permiso_id' => 8, 'rol_id' => 8],
            ['permiso_id' => 9, 'rol_id' => 8],
            ['permiso_id' => 10, 'rol_id' => 8],
            ['permiso_id' => 7, 'rol_id' => 8],

            ['permiso_id' => 1, 'rol_id' => 9],
            ['permiso_id' => 2, 'rol_id' => 9],
            ['permiso_id' => 3, 'rol_id' => 9],
            ['permiso_id' => 4, 'rol_id' => 9],
            ['permiso_id' => 5, 'rol_id' => 9],
            ['permiso_id' => 6, 'rol_id' => 9],
            ['permiso_id' => 7, 'rol_id' => 9],

        )->create();
    }
}
