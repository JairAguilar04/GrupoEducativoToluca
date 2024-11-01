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
        Schema::create('tutor_alumno', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('usuario_id')
                ->constrained('users', 'id');
            $table->enum('parentesco', ['Padre', 'Madre'])->nullable();
            $table->string('nombre_completo', 200)->nullable();
            $table->string('domicilio')->nullable();
            $table->string('escolaridad', 100)->nullable();
            $table->string('ocupacion', 150)->nullable();
            $table->string('telefono', 20)->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutor_alumno');
    }
};
