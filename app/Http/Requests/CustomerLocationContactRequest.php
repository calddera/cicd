<?php

namespace App\Http\Requests;

use App\Rules\UniqueSoft;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomerLocationContactRequest extends BaseFormRequest
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
            'customer_location_id' => 'required|exists:customer_locations,customer_location_id,deleted_at,NULL',
            'contact_name' => [
                'required',
                'max:255'
            ],
            'contact_email' => 'nullable|email|max:255',
            'contact_phone_number' => 'nullable|max:13',
            'is_active' => 'required|boolean',
        ];
    }
}
