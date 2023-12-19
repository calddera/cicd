<?php

namespace App\Http\Requests;

use App\Rules\UniqueSoft;

class DocumentTypeRequest extends BaseFormRequest
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
            'document_type_name' => [
                'required',
                'string',
                new UniqueSoft('document_types', 'document_type_id', $this->document_type)
            ]
        ];
    }



}
