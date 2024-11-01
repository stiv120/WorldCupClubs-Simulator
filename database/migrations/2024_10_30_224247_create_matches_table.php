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
            $table->foreignId('simulacion_id')->constrained('simulaciones')->onDelete('cascade');
            $table->foreignId('equipo_local_id')->constrained('equipos');
            $table->foreignId('equipo_visitante_id')->constrained('equipos');
            $table->enum('fase', ['octavos', 'cuartos', 'semifinal', 'final']);
            $table->integer('orden_partido');
            $table->date('fecha');
            $table->integer('goles_local')->default(0);
            $table->integer('goles_visitante')->default(0);
            $table->integer('tarjetas_amarillas_local')->default(0);
            $table->integer('tarjetas_amarillas_visitante')->default(0);
            $table->integer('tarjetas_rojas_local')->default(0);
            $table->integer('tarjetas_rojas_visitante')->default(0);
            $table->foreignId('equipo_ganador_id')->nullable()->constrained('equipos');
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
