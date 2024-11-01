<?php

namespace Src\Shared\Infrastructure\Services;

use Illuminate\Support\Facades\Storage;
use Src\Shared\Domain\Services\FileStorageService;

/**
 * Implementación del servicio de almacenamiento de archivos usando Laravel Storage
 * Esta clase proporciona la implementación concreta del FileStorageService
 * utilizando el sistema de almacenamiento de Laravel.
 *
 * @package Src\Shared\Infrastructure\Services
 */
class LaravelFileStorageService implements FileStorageService
{
    /**
     * Disco de almacenamiento a utilizar
     * @var string
     */
    private $disk;

    /**
     * Constructor del servicio
     * @param string $disk Nombre del disco de almacenamiento (por defecto: 'public')
     */
    public function __construct(string $disk = 'public')
    {
        $this->disk = $disk;
    }

    /**
     * Almacena un archivo usando Laravel Storage
     * @param mixed $file Archivo a almacenar (UploadedFile)
     * @param string $path Ruta donde se almacenará el archivo
     * @return string Ruta del archivo almacenado
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException Si hay un error al almacenar
     */
    public function store($file, string $path): string
    {
        return $file->store($path, $this->disk);
    }

    /**
     * Elimina un archivo usando Laravel Storage
     * @param string $path Ruta del archivo a eliminar
     * @return bool Verdadero si se eliminó correctamente
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException Si el archivo no existe
     */
    public function delete(string $path): bool
    {
        return Storage::disk($this->disk)->delete($path);
    }

    /**
     * Obtiene la URL pública del archivo usando Laravel Storage
     * @param string $path Ruta del archivo
     * @return string URL pública del archivo
     */
    public function getUrl(string $path): string
    {
        return Storage::disk($this->disk)->url($path);
    }
}
