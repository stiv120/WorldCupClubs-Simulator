<?php

namespace Src\Team\Infrastructure\Request;

use Illuminate\Validation\Rule;
use App\Http\Requests\FormRequest;

/**
 * Request para la validación de creación de equipos
 * @package Src\Team\Infrastructure\Request
 */
class StoreTeamRequest extends FormRequest
{
    /**
     * Define las reglas de validación para la creación de equipos
     * @return array Reglas de validación
     * Las reglas incluyen:
     * - país: requerido, string, máximo 255 caracteres
     * - nombre: requerido, string, máximo 255 caracteres, único (ignorando espacios y mayúsculas)
     * - url_bandera: requerido, debe ser imagen, tipos permitidos: jpeg,png,jpg,gif, máximo 2MB
     */
    public function rules()
    {
        return [
            'pais' => 'required|string|max:255',
            'nombre' => [
                'required',
                'string',
                'max:255',
                Rule::unique('equipos', 'nombre')
                    ->where(function ($query) {
                        return $query->whereRaw('LOWER(REPLACE(nombre, " ", "")) = ?', [
                            strtolower(str_replace(" ", "", $this->nombre))
                        ]);
                    }),
            ],
            'url_bandera' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }

    /**
     * Define los mensajes personalizados para las reglas de validación
     * @return array Mensajes de error personalizados
     * Los mensajes incluyen:
     * - Validaciones para la imagen (requerida, tipo, tamaño)
     * - Validación de unicidad del nombre
     */
    public function messages()
    {
        return [
            'url_bandera.required' => 'La imagen es requerida',
            'url_bandera.image' => 'El archivo debe ser una imagen',
            'url_bandera.max' => 'La imagen no debe ser mayor a 2MB',
            'url_bandera.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg, gif',
            'nombre.unique' => 'Ya existe un equipo con este nombre'
        ];
    }
}
