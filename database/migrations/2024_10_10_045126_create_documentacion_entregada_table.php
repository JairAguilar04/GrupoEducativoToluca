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
        Schema::create('documentacion_entregada', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('usuario_id')
                ->constrained('users', 'id');
            $table->foreignId('documento_id')
                ->constrained('documentos_entregar')->nullable();
            $table->tinyInteger('entrego')->nullable();
            $table->date('fecha_recepcion')->nullable();
            $table->uuid('usuario_recibe')->nullable();
            $table->date('fecha_devolucion')->nullable();
            $table->uuid('usuario_devuelve')->nullable();
            $table->tinyInteger('entrego_todo')->nullable()
                ->comment('Este campo es para los docentes');
            $table->string('observaciones')->nullable()
                ->comment('Este campo es para los docentes');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentacion_entregada');
    }
};
