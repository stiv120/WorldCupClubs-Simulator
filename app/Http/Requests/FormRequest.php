<?php

namespace App\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest as FormRequestOriginal;

abstract class FormRequest extends FormRequestOriginal
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    public function failedValidation($validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => 'Errores de validación!',
            'errors' => is_array($validator) ? $validator : $validator->errors()
        ], 422));
    }
}
