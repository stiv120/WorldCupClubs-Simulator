<?php

namespace Src\Team\Domain\Entities;

/**
 * Entidad que representa un Equipo
 * @package Src\Team\Domain\Entities
 */
class Team
{
    /** @var int|null ID del equipo */
    private $id;

    /** @var string País del equipo */
    private $pais;

    /** @var string Nombre del equipo */
    private $nombre;

    /** @var string URL de la bandera del equipo */
    private $urlBandera;

    /**
     * Constructor de la entidad Team
     * @param array $data Datos del equipo
     */
    public function __construct(array $data)
    {
        $this->pais = $data['pais'];
        $this->id = $data['id'] ?? null;
        $this->nombre = $data['nombre'];
        $this->urlBandera = $data['url_bandera'];
    }

    /**
     * Obtiene el ID del equipo
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Obtiene el país del equipo
     * @return string
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Obtiene el nombre del equipo
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Obtiene la URL de la bandera del equipo
     * @return string
     */
    public function getUrlBandera()
    {
        return $this->urlBandera;
    }
}
