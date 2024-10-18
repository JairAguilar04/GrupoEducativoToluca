<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ModalidadEstudio>
 */
class ModalidadEstudioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nivel_id' => null,
            'nombre' => fake()->name(),
            'duracion' => null,
        ];
    }
}
