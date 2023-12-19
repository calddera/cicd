<?php

namespace App\Models;

use App\Models\Truck;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class TruckTire extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $primaryKey = 'truck_tire_id';

    protected $fillable = [
        'truck_id',
        'buy_date',
        'buy_price',
        'serial_number',
        'is_active',
    ];

    public function truck()
    {
        return $this->belongsTo(Truck::class, 'truck_id', 'truck_id');
    }
}
