<?php

// app/Models/LocationType.php

namespace App\Models;

use App\Models\CustomerLocation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LocationType extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'location_type_id';
    protected $fillable = [
        'location_type_name'
    ];

    public function customerLocations()
    {
        return $this->hasMany(CustomerLocation::class, 'customer_location_id', 'customer_location_id');
    }
}
