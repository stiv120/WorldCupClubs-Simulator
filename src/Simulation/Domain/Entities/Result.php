<?php

namespace Src\Simulation\Domain\Entities;

class Result
{
    private $id;
    private $simulacionId;
    private $equipoId;
    private $eliminado;
    private $campeon;
    private $partidosJugados;
    private $partidosGanados;
    private $partidosPerdidos;
    private $golesFavor;
    private $golesContra;
    private $tarjetasAmarillasTotales;
    private $tarjetasRojasTotales;
    private $posicionFinal;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->simulacionId = $data['simulacion_id'];
        $this->equipoId = $data['equipo_id'];
        $this->eliminado = $data['eliminado'] ?? false;
        $this->campeon = $data['campeon'] ?? false;
        $this->partidosJugados = $data['partidos_jugados'] ?? 0;
        $this->partidosGanados = $data['partidos_ganados'] ?? 0;
        $this->partidosPerdidos = $data['partidos_perdidos'] ?? 0;
        $this->golesFavor = $data['goles_favor'] ?? 0;
        $this->golesContra = $data['goles_contra'] ?? 0;
        $this->tarjetasAmarillasTotales = $data['tarjetas_amarillas_totales'] ?? 0;
        $this->tarjetasRojasTotales = $data['tarjetas_rojas_totales'] ?? 0;
        $this->posicionFinal = $data['posicion_final'] ?? null;
    }

    // Getters
    public function getId() { return $this->id; }
    public function getSimulacionId() { return $this->simulacionId; }
    public function getEquipoId() { return $this->equipoId; }
    public function isEliminado() { return $this->eliminado; }
    public function isCampeon() { return $this->campeon; }
    public function getPartidosJugados() { return $this->partidosJugados; }
    public function getPartidosGanados() { return $this->partidosGanados; }
    public function getPartidosPerdidos() { return $this->partidosPerdidos; }
    public function getGolesFavor() { return $this->golesFavor; }
    public function getGolesContra() { return $this->golesContra; }
    public function getTarjetasAmarillasTotales() { return $this->tarjetasAmarillasTotales; }
    public function getTarjetasRojasTotales() { return $this->tarjetasRojasTotales; }
    public function getPosicionFinal() { return $this->posicionFinal; }
}
