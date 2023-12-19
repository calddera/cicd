<?php

namespace App\Http\Requests;

use App\Rules\UniqueSoft;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TruckRequest extends BaseFormRequest
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
            'unit_number' => [
                'required',
                'string',
                'max:5',
                new UniqueSoft('trucks', 'truck_id', $this->truck)
            ],
            'vin_number' => [
                'required',
                'string',
                'size:17',
                new UniqueSoft('trucks', 'truck_id', $this->truck)
            ],
            'vehicle_status_id' => 'required|exists:vehicle_statuses,vehicle_status_id,deleted_at,NULL',
            'is_active' => 'required|boolean',
            'odometer' => 'required|decimal:1,6',
            'odometer_last_updated_at' => 'nullable|date|before_or_equal:today',
            'fuel_percent' => 'required|integer|max:100',
            'fuel_last_updated_at' => 'nullable|date|before_or_equal:today',
        ];
    }
}
