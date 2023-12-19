<?php

namespace App\Http\Requests;

use App\Rules\UniqueSoft;

class ContractTypeRequest extends BaseFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'contract_type_name' => [
                'required',
                'string',
                'max:255',
                new UniqueSoft('contract_types', 'contract_type_id', $this->contract_type),
            ],
            'is_active' => 'sometimes|boolean',
        ];
    }
}
