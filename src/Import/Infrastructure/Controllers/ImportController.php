<?php

namespace Src\Import\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use App\Exceptions\CustomJsonException;
use Src\Import\Application\UseCases\ImportFileUseCase;
use Src\Import\Infrastructure\Request\ImportFileRequest;

/**
 * Controlador para la gestión de Equipos
 * @package Src\Team\Infrastructure\Controllers
 */
class ImportController extends Controller
{
    /** @var ImportFileUseCase */
    private $importFileUseCase;

    /**
     * Constructor del controlador
     * @param ImportFileUseCase $importFileUseCase Caso de uso para importar un archivo CSV
     */
    public function __construct(ImportFileUseCase $importFileUseCase)
    {
        $this->importFileUseCase = $importFileUseCase;
    }

    /**
     * Muestra la vista principal con el listado de equipos
     * @return \Illuminate\View\View Vista con la lista de equipos
     */
    public function index()
    {
        return view('imports/index');
    }

    /**
     * Almacena un nuevo Equipo en la base de datos
     * @param ImportFileRequest $request Request validado con los datos del equipo
     * @return \Illuminate\Http\JsonResponse Respuesta JSON con el resultado de la operación
     * @throws CustomJsonException Si hay un error durante el proceso de creación
     */
    public function store(ImportFileRequest $request)
    {
        $imported = $this->importFileUseCase->execute($request->all());

        if (!$imported) {
            throw new CustomJsonException(['message' => 'Error al importar el archivo.']);
        }
        return response()->json(['message' => 'Archivo importado correctamente.'], 201);
    }
}
