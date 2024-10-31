<?php

namespace Src\Team\Domain\Entities;

class Team
{
    private $id;
    private $nombre;
    private $pais;
    private $urlBandera;

    public function __construct(array $data)
    {
        $this->pais = $data['pais'];
        $this->id = $data['id'] ?? null;
        $this->nombre = $data['nombre'];
        $this->urlBandera = $data['url_bandera'];
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getPais() {
        return $this->pais;
    }

    public function getUrlBandera() {
        return $this->urlBandera;
    }
}
