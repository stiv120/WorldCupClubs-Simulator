<?php

namespace Src\Import\Application\UseCases;

use App\Exceptions\CustomJsonException;
use Src\Shared\Domain\Services\FileStorageService;
use Src\Import\Domain\Repositories\ImportRepositoryInterface;

/**
 * Caso de uso para registrar un nuevo equipo
 * @package Src\Import\Application\UseCases
 */
class ImportFileUseCase
{
    /**
     * Servicio para el manejo de archivos
     * @var FileStorageService
     */
    private $fileStorage;

    /**
     * Repositorio de equipos
     * @var ImportRepositoryInterface
     */
    private $importRepository;

    /**
     * Constructor del caso de uso
     * @param FileStorageService $fileStorage Servicio para almacenamiento de archivos
     * @param ImportRepositoryInterface $importRepository Repositorio para persistencia de equipos
     */
    public function __construct(
        FileStorageService $fileStorage,
        ImportRepositoryInterface $importRepository
    ) {
        $this->fileStorage = $fileStorage;
        $this->importRepository = $importRepository;
    }

    /**
     * Ejecuta el caso de uso para registrar un nuevo equipo
     * @param array $data Datos del equipo a registrar
     * @return bool Verdadero si el equipo se registró correctamente, falso en caso contrario
     * @throws \Exception Si hay un error al guardar el archivo o crear el equipo
     */
    public function execute(array $data)
    {
        // Procesar el archivo CSV
        $csvPath = $this->fileStorage->store($data['archivo'], 'imports');

        // Importar datos del CSV
        $imported = $this->importRepository->importFromCsv($csvPath);

        // Limpiar archivo temporal
        $this->fileStorage->delete($csvPath);

        return $imported;
    }
}
