<?php

namespace Src\Simulation\Domain\Entities;

class Simulation
{
    private $id;
    private ?\DateTime $createdAt = null;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->createdAt = $data['created_at'] ?? new \DateTime();
    }

    // Getters
    public function getId() { return $this->id; }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}
