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
        Schema::create('partidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('grupo_id')->constrained('grupos');
            $table->foreignId('equipo_local_id')->constrained('equipos');
            $table->foreignId('equipo_visitante_id')->constrained('equipos');
            $table->date('fecha');
            $table->integer('goles_local')->default(0);
            $table->integer('goles_visitante')->default(0);
            $table->integer('tarjetas_amarillas_local')->default(0);
            $table->integer('tarjetas_amarillas_visitante')->default(0);
            $table->integer('tarjetas_rojas_local')->default(0);
            $table->integer('tarjetas_rojas_visitante')->default(0);
            $table->timestamp('fecha_creacion')->useCurrent();
            $table->timestamp('fecha_actualizacion')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partidos');
    }
};
