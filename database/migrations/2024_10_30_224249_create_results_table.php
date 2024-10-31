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
        Schema::create('resultados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipo_id')->constrained('equipos');
            $table->foreignId('grupo_id')->constrained('grupos');
            $table->integer('partidos_ganados')->default(0);
            $table->integer('partidos_perdidos')->default(0);
            $table->integer('goles_totales')->default(0);
            $table->integer('tarjetas_amarillas_totales')->default(0);
            $table->integer('tarjetas_rojas_totales')->default(0);
            $table->integer('posicion_final')->nullable();
            $table->timestamp('fecha_creacion')->useCurrent();
            $table->timestamp('fecha_actualizacion')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resultados');
    }
};
