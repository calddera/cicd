<?php

namespace App\Models;

use App\Models\User;
use App\Models\Employee;
use App\Models\TruckTag;
use App\Models\TruckTire;
use App\Models\TruckPlate;
use App\Models\DriverTruck;
use App\Models\TruckDocument;
use App\Models\VehicleStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Truck extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $primaryKey = 'truck_id';

    protected $fillable = [
        'unit_number',
        'vin_number',
        'odometer',
        'odometer_last_updated_at',
        'fuel_percent',
        'fuel_last_updated_at',
        'vehicle_status_id',
        'is_active',
        'created_by',
        'updated_by'
    ];

    public function truckPlates()
    {
        return $this->hasMany(TruckPlate::class, 'truck_id', 'truck_id');
    }

    public function currentPlate()
    {
        return $this->hasOne(TruckPlate::class, 'truck_id', 'truck_id')->ofMany([
            'created_at' => 'max'
        ], function ($query) {
            $query->where('is_active', '=', 1);
        });
    }

    public function vehicleStatus()
    {
        return $this->belongsTo(VehicleStatus::class, 'vehicle_status_id', 'vehicle_status_id');
    }

    public function truckTags()
    {
        return $this->hasMany(TruckTag::class, 'truck_id', 'truck_id');
    }

    public function truckTires()
    {
        return $this->hasMany(TruckTire::class, 'truck_id', 'truck_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'user_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'user_id');
    }

    public function truckDocuments()
    {
        return $this->hasMany(TruckDocument::class, 'truck_id', 'truck_id');
    }

    public function drivers()
    {
        return $this->belongsToMany(Employee::class, 'driver_truck', 'truck_id', 'employee_id')
            ->using(DriverTruck::class);
    }
}
