<?php

namespace Src\Simulation\Domain\Entities;

class MatchGame
{
    private $id;
    private $simulacionId;
    private $fase;
    private $ordenPartido;
    private $fecha;
    private $golesLocal;
    private $golesVisitante;
    private $equipoLocalId;
    private $equipoVisitanteId;
    private $equipoGanadorId;
    private $tarjetasRojasLocal;
    private $tarjetasRojasVisitante;
    private $tarjetasAmarillasLocal;
    private $tarjetasAmarillasVisitante;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->simulacionId = $data['simulacion_id'];
        $this->fase = $data['fase'];
        $this->ordenPartido = $data['orden_partido'];
        $this->fecha = $data['fecha'];
        $this->golesLocal = $data['goles_local'] ?? 0;
        $this->golesVisitante = $data['goles_visitante'] ?? 0;
        $this->equipoLocalId = $data['equipo_local_id'];
        $this->equipoVisitanteId = $data['equipo_visitante_id'];
        $this->equipoGanadorId = $data['equipo_ganador_id'] ?? null;
        $this->tarjetasRojasLocal = $data['tarjetas_rojas_local'] ?? 0;
        $this->tarjetasRojasVisitante = $data['tarjetas_rojas_visitante'] ?? 0;
        $this->tarjetasAmarillasLocal = $data['tarjetas_amarillas_local'] ?? 0;
        $this->tarjetasAmarillasVisitante = $data['tarjetas_amarillas_visitante'] ?? 0;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getSimulacionId() { return $this->simulacionId; }
    public function getFase() { return $this->fase; }
    public function getOrdenPartido() { return $this->ordenPartido; }
    public function getFecha() { return $this->fecha; }
    public function getGolesLocal() { return $this->golesLocal; }
    public function getGolesVisitante() { return $this->golesVisitante; }
    public function getEquipoLocalId() { return $this->equipoLocalId; }
    public function getEquipoVisitanteId() { return $this->equipoVisitanteId; }
    public function getEquipoGanadorId() { return $this->equipoGanadorId; }
    public function getTarjetasRojasLocal() { return $this->tarjetasRojasLocal; }
    public function getTarjetasRojasVisitante() { return $this->tarjetasRojasVisitante; }
    public function getTarjetasAmarillasLocal() { return $this->tarjetasAmarillasLocal; }
    public function getTarjetasAmarillasVisitante() { return $this->tarjetasAmarillasVisitante; }
}
