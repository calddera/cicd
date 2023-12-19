<?php

namespace App\Http\Requests;

use App\Rules\UniqueSoft;

class DocumentRequest extends BaseFormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'document_name' => [
                'required',
                'string',
                'max:255',
                new UniqueSoft('documents', 'document_id', $this->document)
            ],
            'document_type_id' => "required|exists:document_types,document_type_id,deleted_at,NULL",
            'is_mandatory' => 'required|boolean',
        ];
    }
}
