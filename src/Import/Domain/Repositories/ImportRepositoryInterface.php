<?php

namespace Src\Import\Domain\Repositories;

interface ImportRepositoryInterface
{
    /**
     * Importa datos desde un archivo CSV
     * @param string $csvPath Ruta al archivo CSV
     * @return bool
     */
    public function importFromCsv(string $csvPath);
}


