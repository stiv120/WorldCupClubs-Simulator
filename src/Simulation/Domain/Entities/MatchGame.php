<?php

namespace Src\Simulation\Domain\Entities;

class MatchGame
{
    private $id;
    private $simulacionId;
    private $ordenPartido;
    private $golesLocal;
    private $golesVisitante;
    private $equipoLocalId;
    private $equipoVisitanteId;
    private $equipoGanadorId;
    private $tarjetasRojasLocal;
    private $tarjetasRojasVisitante;
    private $tarjetasAmarillasLocal;
    private $tarjetasAmarillasVisitante;

    public function __construct(array $attributes = [])
    {
        $this->id = $attributes['id'] ?? null;
        $this->simulacionId = $attributes['simulacion_id'] ?? null;
        $this->ordenPartido = $attributes['orden_partido'];
        $this->golesLocal = $attributes['goles_local'] ?? 0;
        $this->golesVisitante = $attributes['goles_visitante'] ?? 0;
        $this->equipoLocalId = $attributes['equipo_local_id'] ?? null;
        $this->equipoVisitanteId = $attributes['equipo_visitante_id'] ?? null;
        $this->equipoGanadorId = $attributes['equipo_ganador_id'] ?? null;
        $this->tarjetasRojasLocal = $attributes['tarjetas_rojas_local'] ?? 0;
        $this->tarjetasRojasVisitante = $attributes['tarjetas_rojas_visitante'] ?? 0;
        $this->tarjetasAmarillasLocal = $attributes['tarjetas_amarillas_local'] ?? 0;
        $this->tarjetasAmarillasVisitante = $attributes['tarjetas_amarillas_visitante'] ?? 0;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getSimulacionId() { return $this->simulacionId; }
    public function getOrdenPartido() { return $this->ordenPartido; }
    public function getGolesLocal() { return $this->golesLocal; }
    public function getGolesVisitante() { return $this->golesVisitante; }
    public function getEquipoLocalId() { return $this->equipoLocalId; }
    public function getEquipoVisitanteId() { return $this->equipoVisitanteId; }
    public function getTarjetasRojasLocal() { return $this->tarjetasRojasLocal; }
    public function getTarjetasRojasVisitante() { return $this->tarjetasRojasVisitante; }
    public function getTarjetasAmarillasLocal() { return $this->tarjetasAmarillasLocal; }
    public function getTarjetasAmarillasVisitante() { return $this->tarjetasAmarillasVisitante; }

    public function setEquipoGanadorId(?int $equipoGanadorId): void
    {
        $this->equipoGanadorId = $equipoGanadorId;
    }

    public function getEquipoGanadorId(): ?int
    {
        return $this->equipoGanadorId;
    }
}
