<?php

namespace Src\Shared\Domain\Services;

/**
 * Interfaz para el servicio de almacenamiento de archivos
 * Define los métodos necesarios para gestionar el almacenamiento
 * de archivos en cualquier sistema de almacenamiento.
 * @package Src\Shared\Domain\Services
 */
interface FileStorageService
{
    /**
     * Almacena un archivo en el sistema de almacenamiento
     * @param mixed $file Archivo a almacenar
     * @param string $path Ruta donde se almacenará el archivo
     * @return string Ruta del archivo almacenado
     */
    public function store($file, string $path): string;

    /**
     * Elimina un archivo del sistema de almacenamiento
     * @param string $path Ruta del archivo a eliminar
     * @return bool Verdadero si se eliminó correctamente, falso en caso contrario
     */
    public function delete(string $path): bool;

    /**
     * Obtiene la URL pública del archivo
     * @param string $path Ruta del archivo
     * @return string URL pública del archivo
     */
    public function getUrl(string $path): string;
}
