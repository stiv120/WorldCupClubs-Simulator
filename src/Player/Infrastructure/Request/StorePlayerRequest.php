<?php

namespace Src\Player\Infrastructure\Request;

use Illuminate\Validation\Rule;
use App\Http\Requests\FormRequest;

/**
 * Request para la validación de creación de jugadores
 * @package Src\Player\Infrastructure\Request
 */
class StorePlayerRequest extends FormRequest
{
    /**
     * Define las reglas de validación para la creación de jugadores
     * @return array Reglas de validación que incluyen:
     *               - nombre: string, máximo 255 caracteres
     *               - nacionalidad: string, máximo 255 caracteres
     *               - edad: entero entre 15 y 50 años
     *               - posicion: debe ser una de las posiciones válidas
     *               - numero_camiseta: entero entre 1 y 99, único por equipo
     *               - url_foto: imagen válida hasta 2MB
     *               - equipo_id: debe existir en la tabla de equipos
     */
    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
            'nacionalidad' => 'required|string|max:255',
            'edad' => 'required|integer|between:15,50',
            'posicion' => [
                'required',
                'string',
                Rule::in(['Portero', 'Defensa', 'Centrocampista', 'Delantero'])
            ],
            'numero_camiseta' => [
                'required',
                'integer',
                'between:1,99',
                Rule::unique('jugadores')
                    ->where(function ($query) {
                        return $query->where('equipo_id', $this->equipo_id);
                    })
            ],
            'url_foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'equipo_id' => 'required|exists:equipos,id'
        ];
    }

    /**
     * Define los mensajes personalizados para las reglas de validación
     * @return array Mensajes de error personalizados para:
     *               - Validación de imagen
     *               - Tamaño máximo de archivo
     *               - Tipos de archivo permitidos
     *               - Número de camiseta duplicado
     *               - Posiciones válidas
     */
    public function messages()
    {
        return [
            'url_foto.image' => 'El archivo debe ser una imagen',
            'url_foto.max' => 'La imagen no debe ser mayor a 2MB',
            'url_foto.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg, gif',
            'numero_camiseta.unique' => 'Este número de camiseta ya está en uso en el equipo',
            'posicion.in' => 'La posición debe ser: Portero, Defensa, Centrocampista o Delantero'
        ];
    }
}
