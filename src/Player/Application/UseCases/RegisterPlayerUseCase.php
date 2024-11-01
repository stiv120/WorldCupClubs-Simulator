<?php

namespace Src\Player\Application\UseCases;

use Src\Player\Domain\Entities\Player;
use Src\Shared\Domain\Services\FileStorageService;
use Src\Player\Domain\Repositories\PlayerRepositoryInterface;

/**
 * Caso de uso para registrar un nuevo jugador
 * @package Src\Player\Application\UseCases
 */
class RegisterPlayerUseCase
{
    /**
     * Servicio para el manejo de archivos
     * @var FileStorageService
     */
    private $fileStorage;

    /**
     * Repositorio de jugadores
     * @var PlayerRepositoryInterface
     */
    private $playerRepository;

    /**
     * Constructor del caso de uso
     * @param FileStorageService $fileStorage Servicio para almacenamiento de archivos
     * @param PlayerRepositoryInterface $playerRepository Repositorio para persistencia de jugadores
     */
    public function __construct(
        FileStorageService $fileStorage,
        PlayerRepositoryInterface $playerRepository
    ) {
        $this->fileStorage = $fileStorage;
        $this->playerRepository = $playerRepository;
    }

    /**
     * Ejecuta el caso de uso para registrar un nuevo jugador
     * @param array $data Datos del jugador a registrar
     * @return bool Verdadero si el jugador se registró correctamente, falso en caso contrario
     * @throws \Exception Si hay un error al guardar el archivo o crear el jugador
     */
    public function execute(array $data)
    {
        // Si existe un archivo en la data, guardarlo
        if (isset($data['url_foto'])) {
            // Guardar el archivo y obtener la ruta
            $path = $this->fileStorage->store($data['url_foto'], 'players');

            // Actualizar la data con la ruta del archivo
            $data['url_foto'] = $path;
        }

        // Crear y guardar el jugador
        $player = new Player($data);
        $saved = $this->playerRepository->save($player);

        // Si no se guardó correctamente y existe una imagen, eliminarla
        if (!$saved && isset($path)) {
            $this->fileStorage->delete($path);
        }
        return $saved;
    }
}
