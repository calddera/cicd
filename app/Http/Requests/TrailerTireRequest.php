<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrailerTireRequest extends BaseFormRequest
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
            'trailer_id' => 'required|exists:trailers,trailer_id,deleted_at,NULL',
            'buy_date' => 'required|date|before_or_equal:today',
            'buy_price' => 'required|decimal:1,6',
            'serial_number' => 'required|string|max:36',
            'is_active' => 'required|boolean',
        ];
    }
}
