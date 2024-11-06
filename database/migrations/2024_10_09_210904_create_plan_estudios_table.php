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
        Schema::create('plan_estudios', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('usuario_id')
                ->constrained('users', 'id');

            $table->foreignId('nivel_id')
                ->constrained('niveles', 'id');

            $table->foreignId('grado_id')
                ->constrained('grados_academicos', 'id')
                ->nullable();

            $table->foreignId('modalidad_id')
                ->constrained('modalidades_estudios', 'id');

            $table->foreignId('horario_id')
                ->constrained('horarios', 'id');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_estudios');
    }
};
