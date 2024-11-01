<?php

namespace Src\Simulation\Domain\Entities;

class Simulation
{
    private $id;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
    }

    // Getters
    public function getId() { return $this->id; }
}
