<?php

// app/Models/CustomerLocation.php

namespace App\Models;

use App\Models\Customer;
use App\Models\Geofence;
use App\Models\LocationType;
use App\Models\CustomerLocationContact;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerLocation extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'customer_location_id';
    // protected $dates = ['deleted_at'];
    protected $fillable = [
        'customer_id',
        'customer_location_name',
        'location_type_id',
        'location_country',
        'location_zipcode',
        'location_state',
        'location_city',
        'location_address',
        'location_lat',
        'location_lng',
        'geofence_id',
        'is_active'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    public function locationType()
    {
        return $this->belongsTo(LocationType::class, 'location_type_id', 'location_type_id');
    }

    public function customerLocationContacts()
    {
        return $this->hasMany(CustomerLocationContact::class, 'customer_location_id', 'customer_location_id');
    }

    public function geofence()
    {
        return $this->belongsTo(Geofence::class, 'geofence_id', 'geofence_id');
    }
}
