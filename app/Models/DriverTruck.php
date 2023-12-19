<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DriverTruck extends Pivot
{
    use HasFactory, HasUuids;

    protected $table = 'driver_truck';

    protected $primaryKey = 'driver_truck_id';

    protected $fillable = [
        'employee_id',
        'truck_id',
        'is_active',
        'assigned_by',
        'assigned_at'
    ];

    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by', 'user_id');
    }
}
