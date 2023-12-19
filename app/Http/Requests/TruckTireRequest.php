<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TruckTireRequest extends BaseFormRequest
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
            'buy_date' => 'required|date|before_or_equal:today',
            'buy_price' => 'required|decimal:1,6',
            'serial_number' => 'required|string|max:8',
            'is_active' => 'required|boolean'
        ];
    }
}
