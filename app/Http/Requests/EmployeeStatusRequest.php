<?php

namespace App\Http\Requests;

use App\Rules\UniqueSoft;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeStatusRequest extends BaseFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'employee_status_name' => [
                'required',
                'string',
                'max:255',
                new UniqueSoft('employee_statuses', 'employee_status_id', $this->employee_status)
            ]
        ];
    }
}
