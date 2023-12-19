<?php

namespace App\Http\Requests;

use App\Rules\UniqueSoft;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyRequest extends BaseFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'company_name' => 'required|max:300',
            'employer_register' => 'required|string|max:20',
            'RFC' => [
                'required',
                'between:12,13',
                new UniqueSoft('companies', 'company_id', $this->company)
            ],
            'employer_representative' => 'required|max:255',
            'legal_representative' => 'required|max:255',
            'tax_residence' => 'required|max:255',
        ];
    }
}
