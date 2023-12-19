<?php

namespace App\Http\Requests;

use App\Rules\UniqueSoft;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CostCenterRequest extends BaseFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'cost_center_code' => [
                'required',
                'string',
                'max:55',
            ],
            'company_id' => 'required|exists:companies,company_id,deleted_at,NULL',
        ];
    }
}
