<?php

namespace Src\Team\Infrastructure\Request;

use App\Http\Requests\FormRequest;

class StoreTeamRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'pais' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'url_bandera' => 'required|string|max:255'
        ];
    }
}
