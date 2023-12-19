<?php

namespace App\Http\Requests;

use App\Rules\UniqueSoft;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TruckPlateRequest extends BaseFormRequest
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
            'plate_country' => 'required|string|max:3',
            'plate_code' => [
                'required',
                'string',
                'max:8',
                new UniqueSoft('truck_plates', 'truck_plate_id', $this->truck_plate),
            ], 
            'plate_expires_at' => 'nullable|date',
            'plate_photo' => 'nullable|string|max:255',
            'is_active' => 'required|boolean'
        ];
    }
}
