<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            EstatusSeeder::class,
            TipoUsuarioSeeder::class,
            RolSeeder::class,
            PermisoSeeder::class,
            PermisoRolSeeder::class,
            NivelSeeder::class,
            ModalidadEstudioSeeder::class,
            HorarioSeeder::class,
            HorarioModalidadSeeder::class,
            DocumentoEntregarSeeder::class,
            ConceptoPagoSeeder::class,
            CantidadPeriodoPagoSeeder::class,
            PagoSeeder::class,
        ]);
    }
}
