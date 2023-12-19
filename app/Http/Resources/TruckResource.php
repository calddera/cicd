<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TruckResource extends JsonResource
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
            "truck_id" => $this->truck_id,
            "unit_number" => $this->unit_number,
            "vin_number" => $this->vin_number,
            "odometer" => $this->odometer,
            "odometer_last_updated_at" => $this->odometer_last_updated_at,
            "vehicle_status" => $this->vehicleStatus->status_name,
            "is_active" => $this->is_active,
            "fuel_percent" => $this->fuel_percent,
            "fuel_last_updated_at" => $this->fuel_last_updated_at,
            // 'created_by' => $this->createdBy->name,
            // 'updated_by' => $this->updatedBy->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'drivers' => $this->drivers
        ];
    }
}
