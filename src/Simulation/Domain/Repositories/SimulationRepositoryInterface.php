<?php

namespace Src\Simulation\Domain\Repositories;

use Src\Simulation\Domain\Entities\Simulation;

interface SimulationRepositoryInterface
{
    /**
     * Guarda o actualiza una simulación
     * @param Simulation $simulation
     * @return bool
     */
    public function save(Simulation $simulation): bool;

    /**
     * Encuentra una simulación por su ID
     * @param int $id
     * @return Simulation|null
     */
    public function findById(int $id): ?Simulation;

    /**
     * Obtiene todas las simulaciones
     * @return array<Simulation>
     */
    public function findAll(): array;

    /**
     * Encuentra simulaciones por fase
     * @param string $fase
     * @return array<Simulation>
     */
    public function findByFase(string $fase): array;

    /**
     * Obtiene las estadísticas de un equipo
     * @param int $equipoId
     * @return array
     */
    public function getTeamStats(int $equipoId): array;

    /**
     * Obtiene el equipo campeón de la simulación
     * @return Simulation|null
     */
    public function getChampion(): ?Simulation;

    /**
     * Obtiene la última simulación creada
     * @return Simulation|null
     */
    public function getLastSimulation(): ?Simulation;

    /**
     * Obtiene simulaciones por estado
     * @param string $status
     * @return array<Simulation>
     */
    public function findByStatus(string $status): array;
}
