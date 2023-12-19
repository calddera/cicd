<?php

namespace App\Http\Requests;

use App\Rules\UniqueSoft;
use Illuminate\Foundation\Http\FormRequest;

class WorkdayTypeRequest extends BaseFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'workday_type_name' => [
                'required',
                'string',
                'max:255',
                new UniqueSoft('workday_types', 'workday_type_id', $this->workday_type)
            ],
            'workday_description_name' => 'required|string|max:255',
        ];
    }
}
