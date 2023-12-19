<?php

// app/Models/CustomerLocationContact.php

namespace App\Models;

use App\Models\CustomerLocation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerLocationContact extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'customer_location_contact_id';
    // protected $dates = ['deleted_at'];
    protected $fillable = [
        'customer_location_id',
        'contact_name',
        'contact_email',
        'contact_phone_number',
        'is_active',
    ];

    public function customerLocation()
    {
        return $this->belongsTo(CustomerLocation::class, 'customer_location_id', 'customer_location_id');
    }
}

