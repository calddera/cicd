<?php

namespace App\Http\Requests;

use App\Rules\UniqueSoft;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends BaseFormRequest
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
        $rules = [
            'customer_name' => [
                'required',
                'string',
                'max:255',
                new UniqueSoft('customers', 'customer_id', $this->customer)
            ],
            'customer_tax_residence' => [
                'required',
                'max:255'
            ],
            'RFC' => [
                'required',
                'size:13',
                new UniqueSoft('customers', 'customer_id', $this->customer)
            ],
            'customer_status_id' => 'required|exists:customer_statuses,customer_status_id,deleted_at,NULL',
            'is_active' => 'required|boolean'
        ];

        return $rules;
    }
}
