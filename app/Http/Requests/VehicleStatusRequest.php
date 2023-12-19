<?php

namespace App\Http\Requests;

use App\Models\VehicleStatus;
use App\Rules\UniqueSoft;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class VehicleStatusRequest extends BaseFormRequest
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
            'status_name' => [
                'required',
                'string',
                'max:255',
                new UniqueSoft('vehicle_statuses', 'vehicle_status_id', $this->vehicle_status)
            ]
        ];
    }
}
