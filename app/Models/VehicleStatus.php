<?php

namespace App\Models;

use App\Models\Truck;
use App\Models\Trailer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleStatus extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'vehicle_status_id';

    protected $fillable = [
        'status_name'
    ];

    public function trucks()
    {
        return $this->hasMany(Truck::class, 'truck_id', 'truck_id');
    }

    public function trailers()
    {
        return $this->hasMany(Trailer::class, 'trailer_id', 'trailer_id');
    }
}
