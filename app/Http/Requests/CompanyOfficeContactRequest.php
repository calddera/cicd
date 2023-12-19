<?php

namespace App\Http\Requests;

use App\Rules\UniqueSoft;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyOfficeContactRequest extends BaseFormRequest
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
            'company_office_id' => 'required|exists:company_offices,company_office_id,deleted_at,NULL',
            'contact_name' => 'required|string|max:255',
            'contact_address' => 'nullable|string|max:255',
            'contact_phone_number' => 'nullable|string|between:10,13',
            'contact_email' => 'nullable|email|max:255'
        ];
    }
}
