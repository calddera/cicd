<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TrailerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'trailer_id' => $this->trailer_id,
            'unit_number' => $this->unit_number,
            'vin_number' => $this->vin_number,
            'vehicle_status' => $this->vehicleStatus->status_name,
            'trailer_type' => $this->trailerType->trailer_type_name,
            'is_active' => $this->is_active,
            'trailer_model' => $this->trailerModel->trailer_model_name,
            'trademark' => $this->trademark,
            'IMAI' => $this->IMAI,
            // 'created_by' => $this->createdBy->name,
            // 'updated_by' => $this->updatedBy->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
