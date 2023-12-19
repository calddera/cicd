<?php

namespace App\Http\Requests;

use App\Rules\UniqueSoft;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TrailerRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'unit_number' => [
                'required',
                'string',
                'max:5',
                new UniqueSoft('trailers', 'trailer_id', $this->trailer)
            ],
            'vin_number' => [
                'required',
                'string',
                'size:17',
                new UniqueSoft('trailers', 'trailer_id', $this->trailer)
            ],
            'vehicle_status_id' => 'required|exists:vehicle_statuses,vehicle_status_id,deleted_at,NULL',
            'trailer_type_id' => 'required|exists:trailer_types,trailer_type_id,deleted_at,NULL',
            'is_active' => 'required|boolean',
            'trailer_model_id' => 'required|exists:trailer_models,trailer_model_id,deleted_at,NULL',
            'trademark' => 'nullable|string|max:255',
            'IMAI' => [
                'nullable',
                'string',
                'max:255'
            ],
        ];
    }
}
