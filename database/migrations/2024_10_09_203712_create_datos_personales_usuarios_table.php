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
        Schema::create('datos_personales_usuarios', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('usuario_id')
                ->constrained('users', 'id')
                ->noActionOnUpdate()
                ->onDelete('cascade');
            $table->string('perfil_academico', 150)->nullable();
            $table->date('fecha_nacimiento');
            $table->string('curp', 18)->nullable();
            $table->integer('edad');
            $table->enum('sexo', ['F', 'M']);
            $table->string('domicilio', 255);
            $table->string('colonia', 150);
            $table->string('localidad_municipio', 150);
            $table->string('telefono', 20);

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datos_personales_usuarios');
    }
};
