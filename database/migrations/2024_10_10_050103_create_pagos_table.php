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
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nivel_id')
                ->constrained('niveles');
            $table->foreignId('concepto_id')
                ->constrained('conceptos_pagos');
            $table->foreignId('periodo_id')
                ->nullable()
                ->constrained('cantidad_periodo_pagos');
            $table->float('monto_unitario', 1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
