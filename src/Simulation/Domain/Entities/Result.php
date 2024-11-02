<?php

namespace Src\Simulation\Domain\Entities;

class Result
{
    private $id;
    private $simulacion_id;
    private $equipo_id;
    private $eliminado;
    private $campeon;
    private $partidos_jugados;
    private $partidos_ganados;
    private $partidos_perdidos;
    private $goles_favor;
    private $goles_contra;
    private $tarjetas_amarillas_totales;
    private $tarjetas_rojas_totales;
    private $posicion_final;

    public function __construct(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSimulacionId(): ?int
    {
        return $this->simulacion_id;
    }

    public function getEquipoId(): ?int
    {
        return $this->equipo_id;
    }

    public function isEliminado(): bool
    {
        return $this->eliminado ?? false;
    }

    public function isCampeon(): bool
    {
        return $this->campeon ?? false;
    }

    public function getPartidosJugados(): int
    {
        return $this->partidos_jugados;
    }

    public function setPartidosJugados(int $partidos_jugados): void
    {
        $this->partidos_jugados = $partidos_jugados;
    }

    public function getPartidosGanados(): int
    {
        return $this->partidos_ganados;
    }

    public function getPartidosPerdidos(): int
    {
        return $this->partidos_perdidos;
    }

    public function setPartidosPerdidos(int $partidos_perdidos): void
    {
        $this->partidos_perdidos = $partidos_perdidos;
    }

    public function getGolesFavor(): int
    {
        return $this->goles_favor ?? 0;
    }

    public function getGolesContra(): int
    {
        return $this->goles_contra ?? 0;
    }

    public function getTarjetasAmarillasTotales(): int
    {
        return $this->tarjetas_amarillas_totales ?? 0;
    }

    public function getTarjetasRojasTotales(): int
    {
        return $this->tarjetas_rojas_totales ?? 0;
    }

    public function getPosicionFinal(): ?int
    {
        return $this->posicion_final;
    }

    public function updateMatchStats(
        int $golesFavor,
        int $golesContra,
        int $tarjetasAmarillas,
        int $tarjetasRojas,
        bool $isWinner
    ): void {
        $this->goles_favor = ($this->goles_favor ?? 0) + $golesFavor;
        $this->goles_contra = ($this->goles_contra ?? 0) + $golesContra;
        $this->tarjetas_amarillas_totales = ($this->tarjetas_amarillas_totales ?? 0) + $tarjetasAmarillas;
        $this->tarjetas_rojas_totales = ($this->tarjetas_rojas_totales ?? 0) + $tarjetasRojas;
        $this->partidos_jugados = ($this->partidos_jugados ?? 0) + 1;

        if ($isWinner) {
            $this->partidos_ganados = ($this->partidos_ganados ?? 0) + 1;
        } else {
            $this->partidos_perdidos = ($this->partidos_perdidos ?? 0) + 1;
        }
    }

    public function setCampeon(): void
    {
        $this->campeon = true;
    }
}
