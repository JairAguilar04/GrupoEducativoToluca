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
                ->constrained('users', 'id')
                ->noActionOnUpdate()
                ->onDelete('cascade');
            $table->enum('parentesco', ['Padre', 'Madre']);
            $table->string('nombre_completo', 200);
            $table->string('domicilio');
            $table->string('escolaridad', 100);
            $table->string('ocupacion', 150);
            $table->string('telefono', 20);

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
