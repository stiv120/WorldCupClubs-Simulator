<?php

namespace Src\Simulation\Infrastructure\Persistence;

use Illuminate\Support\Facades\DB;
use Src\Simulation\Domain\Entities\Simulation;
use App\Models\Simulation as EloquentSimulation;
use Src\Simulation\Domain\Repositories\SimulationRepositoryInterface;

/**
 * Implementación Eloquent del repositorio de Jugadores
 * Esta clase proporciona la implementación concreta del repositorio
 * utilizando Eloquent como ORM para la persistencia de datos.
 * @package Src\Simulation\Infrastructure\Persistence
 */
class EloquentSimulationRepository implements SimulationRepositoryInterface
{
    /**
     * Guarda un nuevo jugador en la base de datos
     * @param Simulation $simulation Entidad del jugador a guardar
     * @return bool Verdadero si se guardó correctamente, falso en caso contrario
     * @throws \Exception Si hay un error al guardar en la base de datos
     */
    public function save(Simulation $simulation): bool
    {
        $eloquentSimulation = new EloquentSimulation();

        if ($simulation->getId()) {
            $eloquentSimulation = EloquentSimulation::findOrNew($simulation->getId());
        }

        $saved = $eloquentSimulation->fill([
            'fecha_creacion' => $simulation->getCreatedAt()
        ])->save();

        if ($saved) {
            $simulation->setId($eloquentSimulation->id);
        }

        return $saved;
    }

    public function findById(int $id): ?Simulation
    {
        $sim = EloquentSimulation::find($id);
        return $sim ? new Simulation($sim->toArray()) : null;
    }

    /**
     * Obtiene todos los jugadores de la base de datos
     * @return \Illuminate\Database\Eloquent\Collection Colección de jugadores
     * @throws \Exception Si hay un error al consultar la base de datos
     */
    public function findAll(): array
    {
        return EloquentSimulation::all()
            ->map(fn($sim) => new Simulation($sim->toArray()))
            ->toArray();
    }

    public function findByFase(string $fase): array
    {
        return EloquentSimulation::whereHas('partidos', function($query) use ($fase) {
            $query->where('fase', $fase);
        })
        ->get()
        ->map(fn($sim) => new Simulation($sim->toArray()))
        ->toArray();
    }

    public function getChampion(): ?Simulation
    {
        $champion = EloquentSimulation::whereHas('resultados', function($query) {
            $query->where('campeon', true);
        })->first();

        return $champion ? new Simulation($champion->toArray()) : null;
    }

    public function getLastSimulation(): ?Simulation
    {
        $lastSim = EloquentSimulation::latest('fecha_creacion')->first();

        return $lastSim ? new Simulation($lastSim->toArray()) : null;
    }

    public function findByStatus(string $status): array
    {
        return EloquentSimulation::whereHas('resultados', function($query) use ($status) {
            $query->where('status', $status);
        })
        ->get()
        ->map(fn($sim) => new Simulation($sim->toArray()))
        ->toArray();
    }

    public function deleteAll(): void
    {
        DB::table('simulaciones')->delete();
    }
}



