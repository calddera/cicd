<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TruckDocumentRequest extends BaseFormRequest
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
            'truck_id' => 'required|exists:trucks,truck_id,deleted_at,NULL',
            'document_id' => 'required|exists:documents,document_id,deleted_at,NULL',
            'file_name' => 'required|string|max:255',
            //'file_path' => 'required|string|max:255',
            'valid_until' => 'nullable|date',
            'is_active' => 'required|boolean',
            'file' => 'required|string'
        ];
    }
}
