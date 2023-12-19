<?php

namespace App\Http\Requests;

use App\Rules\UniqueSoft;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DepartmentRequest extends BaseFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'company_id' => 'required|exists:companies,company_id,deleted_at,NULL',
            'department_name' => [
                'required',
                'string',
                'max:255'
            ],
            'is_active' => 'required|boolean',
        ];
    }
}
