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
        Schema::create('permiso_rol', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permiso_id')
                ->constrained('permisos', 'id')
                ->noActionOnUpdate()
                ->onDelete('cascade');
            $table->foreignId('rol_id')
                ->constrained('roles', 'id')
                ->noActionOnUpdate()
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permiso_rol');
    }
};
