<?php

namespace Src\Team\Application\UseCases;

use Src\Team\Domain\Entities\Team;
use Src\Shared\Domain\Services\FileStorageService;
use Src\Team\Domain\Repositories\TeamRepositoryInterface;

/**
 * Caso de uso para registrar un nuevo equipo
 * @package Src\Team\Application\UseCases
 */
class RegisterTeamUseCase
{
    /**
     * Servicio para el manejo de archivos
     * @var FileStorageService
     */
    private $fileStorage;

    /**
     * Repositorio de equipos
     * @var TeamRepositoryInterface
     */
    private $teamRepository;

    /**
     * Constructor del caso de uso
     * @param FileStorageService $fileStorage Servicio para almacenamiento de archivos
     * @param TeamRepositoryInterface $teamRepository Repositorio para persistencia de equipos
     */
    public function __construct(
        FileStorageService $fileStorage,
        TeamRepositoryInterface $teamRepository
    ) {
        $this->fileStorage = $fileStorage;
        $this->teamRepository = $teamRepository;
    }

    /**
     * Ejecuta el caso de uso para registrar un nuevo equipo
     * @param array $data Datos del equipo a registrar
     * @return bool Verdadero si el equipo se registró correctamente, falso en caso contrario
     * @throws \Exception Si hay un error al guardar el archivo o crear el equipo
     */
    public function execute(array $data)
    {
        // Si existe un archivo en la data, guardarlo
        if (isset($data['url_bandera'])) {
            // Guardar el archivo y obtener la ruta
            $path = $this->fileStorage->store($data['url_bandera'], 'teams');

            // Actualizar la data con la ruta del archivo
            $data['url_bandera'] = $path;
        }

        // Crear y guardar el equipo
        $team = new Team($data);
        $saved = $this->teamRepository->save($team);

        // Si no se guardó correctamente y existe una imagen, eliminarla
        if (!$saved && isset($path)) {
            $this->fileStorage->delete($path);
        }
        return $saved;
    }
}
