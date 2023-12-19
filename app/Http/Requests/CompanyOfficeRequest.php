<?php

namespace App\Http\Requests;

use App\Rules\UniqueSoft;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyOfficeRequest extends BaseFormRequest
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
            'company_id' => 'required|exists:companies,company_id,deleted_at,NULL',
            'office_name' => 'required|string|max:255',
            'office_address' => 'required|string|max:255',
            'office_country' => 'required|string|max:3',
            'office_state' => 'nullable|string|max:255',
            'office_city' => 'nullable|string|max:255',
            'office_zip_code' => 'required|string|between:4,6',
            'office_lat' => 'nullable|numeric|between:-90,90',
            'office_lng' => 'nullable|numeric|between:-180,180',
            'is_active' => 'required|boolean'
        ];
    }
}
