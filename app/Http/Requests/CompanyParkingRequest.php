<?php

namespace App\Http\Requests;

use App\Rules\UniqueSoft;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyParkingRequest extends BaseFormRequest
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
            'company_id' => 'required|exists:companies,company_id,deleted_at,NULL',
            'parking_name' => 'required|string|max:255',
            'parking_address' => 'required|string|max:255',
            'geofence_id' => 'nullable|exists:geofences,geofence_id,deleted_at,NULL'
        ];
    }
}
