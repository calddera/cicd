<?php

namespace App\Models;

use App\Models\Truck;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class TruckPlate extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $primaryKey = 'truck_plate_id';

    protected $fillable = [
        'truck_id',
        'plate_country',
        'plate_code',
        'plate_expires_at',
        'plate_photo',
        'is_active',
    ];

    public function truck()
    {
        return $this->belongsTo(Truck::class, 'truck_id', 'truck_id');
    }
}
