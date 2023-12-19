<?php

namespace App\Http\Requests;

use App\Rules\UniqueSoft;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class JobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Puede ajustar la autorización aquí según su lógica de negocios.
        // En este ejemplo, permitiremos todas las solicitudes.
        return true;
    }

    /**
     * Obtener las reglas de validación que se aplican a la solicitud.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'department_id' => 'required|exists:departments,department_id,deleted_at,NULL',
            'job_code' => [
                'required',
                'string',
                'max:255',
            ],
            'job_name' => [
                'required',
                'string',
                'max:255',
            ],
            'is_active' => 'required|boolean'
        ];
    }
}
