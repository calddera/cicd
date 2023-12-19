<?php

namespace App\Http\Requests;

use App\Rules\UniqueSoft;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CustomerLocationRequest extends BaseFormRequest
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
            'customer_id' => 'required|exists:customers,customer_id,deleted_at,NULL',
            'customer_location_name' => [
                'required',
                'max:255',
            ],
            'location_type_id' => 'required|exists:location_types,location_type_id,deleted_at,NULL',
            'location_country' => 'required|size:3',
            'location_zipcode' => 'required|between:5,6',
            'location_state' => 'nullable|max:255',
            'location_city' => 'nullable|max:255',
            'location_address' => 'nullable|max:255',
            'location_lat' => 'nullable|numeric|between:-90,90',
            'location_lng' => 'nullable|numeric|between:-180,180',
            'geofence_id' => 'nullable|exists:geofences,geofence_id,deleted_at,NULL',
            'is_active' => 'required|boolean',
        ];
    }
}
