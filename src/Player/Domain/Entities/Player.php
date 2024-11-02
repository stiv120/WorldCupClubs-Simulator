<?php

namespace Src\Player\Domain\Entities;

/**
 * Entidad que representa un Jugador
 *
 * @package Src\Player\Domain\Entities
 */
class Player
{
    /** @var int|null ID del jugador */
    private $id;

    /** @var string Nombre del jugador */
    private $nombre;

    /** @var string Nacionalidad del jugador */
    private $nacionalidad;

    /** @var int Edad del jugador */
    private $edad;

    /** @var string Posición del jugador */
    private $posicion;

    /** @var int Número de camiseta */
    private $numeroCamiseta;

    /** @var string URL de la foto del jugador */
    private $urlFoto;

    /** @var int ID del equipo al que pertenece */
    private $equipoId;

    /**
     * Constructor de la entidad Player
     *
     * @param array $data Datos del jugador
     */
    public function __construct(array $data)
    {
        $this->edad = $data['edad'];
        $this->id = $data['id'] ?? null;
        $this->nombre = $data['nombre'];
        $this->urlFoto = $data['url_foto'];
        $this->posicion = $data['posicion'];
        $this->equipoId = $data['equipo_id'];
        $this->nacionalidad = $data['nacionalidad'];
        $this->numeroCamiseta = $data['numero_camiseta'];
    }

    /**
     * Obtiene el ID del jugador
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Obtiene el nombre del jugador
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Obtiene la nacionalidad del jugador
     * @return string
     */
    public function getNacionalidad()
    {
        return $this->nacionalidad;
    }

    /**
     * Obtiene la edad del jugador
     * @return int
     */
    public function getEdad()
    {
        return $this->edad;
    }

    /**
     * Obtiene la posición del jugador
     * @return string
     */
    public function getPosicion()
    {
        return $this->posicion;
    }

    /**
     * Obtiene el número de camiseta del jugador
     * @return int
     */
    public function getNumeroCamiseta()
    {
        return $this->numeroCamiseta;
    }

    /**
     * Obtiene la URL de la foto del jugador
     * @return string
     */
    public function getUrlFoto()
    {
        return $this->urlFoto;
    }

    /**
     * Obtiene el ID del equipo al que pertenece el jugador
     * @return int
     */
    public function getEquipoId()
    {
        return $this->equipoId;
    }
}
