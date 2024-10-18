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
                ->constrained('users', 'id')
                ->noActionOnUpdate()
                ->onDelete('cascade');
            $table->foreignId('modalidad_id')
                ->constrained('modalidades_estudios', 'id');
            $table->string('otro')
                ->nullable()
                ->comment('campo en caso de que el usuario haya seleccionado otro');
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
