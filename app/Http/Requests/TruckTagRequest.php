<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TruckTagRequest extends BaseFormRequest
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
            'tag_name' => 'required|string|max:255',
            'valid_until' => 'nullable|date'
        ];
    }
}
