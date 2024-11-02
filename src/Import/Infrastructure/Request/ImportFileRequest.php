<?php

namespace Src\Import\Infrastructure\Request;

use App\Http\Requests\FormRequest;

class ImportFileRequest extends FormRequest
{
    public function rules()
    {
        return [
            'archivo' => [
                'required',
                'file',
                'mimes:csv,txt',  // acepta archivos csv o txt
                'max:10240',      // 10MB máximo
                function ($attribute, $value, $fail) {
                    if ($value) {
                        $handle = fopen($value->getPathname(), 'r');
                        $headers = fgetcsv($handle);
                        fclose($handle);

                        $requiredHeaders = [
                            'equipo',
                            'pais',
                            'url_bandera',
                            'jugador',
                            'numero_camiseta',
                            'posicion',
                            'nacionalidad',
                            'edad',
                            'url_foto'
                        ];

                        $missingHeaders = array_diff($requiredHeaders, $headers);

                        if (!empty($missingHeaders)) {
                            $fail('El archivo CSV no tiene el formato correcto. Faltan las columnas: ' . implode(', ', $missingHeaders));
                        }
                    }
                }
            ]
        ];
    }

    public function messages()
    {
        return [
            'archivo.required' => 'El archivo CSV es requerido',
            'archivo.mimes' => 'El archivo debe ser de tipo CSV',
            'archivo.max' => 'El archivo no debe ser mayor a 10MB',
            'archivo.file' => 'El archivo debe ser un archivo válido'
        ];
    }
}
