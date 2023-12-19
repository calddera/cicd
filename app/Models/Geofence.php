<?php

// app/Models/Geofence.php

namespace App\Models;


use App\Models\CompanyParking;
use App\Models\CustomerLocation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Geofence extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'geofence_id';
    protected $fillable = [
        'geofence_name',
        'is_active'
    ];

    public function customerLocation()
    {
        return $this->belongsTo(CustomerLocation::class, 'customer_location_id', 'customer_location_id');
    }

    public function companyParking()
    {
        return $this->belongsTo(CompanyParking::class, 'customer_location_id', 'customer_location_id');
    }
}

