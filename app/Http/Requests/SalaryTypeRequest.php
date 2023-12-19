<?php

namespace App\Http\Requests;

use App\Rules\UniqueSoft;

class SalaryTypeRequest extends BaseFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'salary_type_name' => [
                'required',
                'max:255',
                new UniqueSoft('salary_types', 'salary_type_id', $this->salary_type)
            ]
        ];
    }
}
