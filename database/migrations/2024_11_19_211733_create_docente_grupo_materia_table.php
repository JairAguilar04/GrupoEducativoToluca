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
        Schema::create('docente_grupo_materia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grupo_id')
                ->constrained('grupos');
            $table->foreignId('materia_id')
                ->constrained('materias');
            $table->foreignUuid('docente_id')
                ->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('docente_grupo_materia');
    }
};
