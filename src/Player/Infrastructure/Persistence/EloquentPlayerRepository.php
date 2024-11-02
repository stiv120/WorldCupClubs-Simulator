<?php

namespace Src\Player\Infrastructure\Persistence;

use Src\Player\Domain\Entities\Player;
use App\Models\Player as EloquentPlayer;
use Src\Player\Domain\Repositories\PlayerRepositoryInterface;

/**
 * Implementación Eloquent del repositorio de Jugadores
 * Esta clase proporciona la implementación concreta del repositorio
 * utilizando Eloquent como ORM para la persistencia de datos.
 * @package Src\Player\Infrastructure\Persistence
 */
class EloquentPlayerRepository implements PlayerRepositoryInterface
{
    /**
     * Guarda un nuevo jugador en la base de datos
     * @param Player $player Entidad del jugador a guardar
     * @return bool Verdadero si se guardó correctamente, falso en caso contrario
     * @throws \Exception Si hay un error al guardar en la base de datos
     */
    public function save(Player $player)
    {
        $eloquentPlayer = new EloquentPlayer();
        $eloquentPlayer->nombre = $player->getNombre();
        $eloquentPlayer->nacionalidad = $player->getNacionalidad();
        $eloquentPlayer->edad = $player->getEdad();
        $eloquentPlayer->posicion = $player->getPosicion();
        $eloquentPlayer->numero_camiseta = $player->getNumeroCamiseta();
        $eloquentPlayer->url_foto = $player->getUrlFoto();
        $eloquentPlayer->equipo_id = $player->getEquipoId();
        return $eloquentPlayer->save();
    }

    /**
     * Obtiene todos los jugadores de la base de datos
     * @return \Illuminate\Database\Eloquent\Collection Colección de jugadores
     * @throws \Exception Si hay un error al consultar la base de datos
     */
    public function findAll()
    {
        return EloquentPlayer::all();
    }
}



