<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('grado_materia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grado_id')
                ->constrained('grados_academicos', 'id');
            $table->foreignId('materia_id')
                ->constrained('materias', 'id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grado_materia');
    }
};
