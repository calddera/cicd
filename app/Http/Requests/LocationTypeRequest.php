<?php

namespace App\Http\Requests;

use App\Rules\UniqueSoft;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class LocationTypeRequest extends BaseFormRequest
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
            'location_type_name' => [
                'required',
                'string',
                'max:255',
                new UniqueSoft('location_types', 'location_type_id', $this->location_type)
            ]
        ];
    }
}
