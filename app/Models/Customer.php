<?php

// app/Models/Customer.php

namespace App\Models;

use App\Models\CustomerStatus;
use App\Models\CustomerLocation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'customer_id';
    // protected $dates = ['deleted_at'];
    protected $fillable = [
        'customer_name',
        'customer_tax_residence',
        'RFC',
        'customer_status_id',
        'is_active'
    ];

    public function customerStatus()
    {
        return $this->belongsTo(CustomerStatus::class, 'customer_status_id', 'customer_status_id');
    }

    public function customerLocations()
    {
        return $this->hasMany(CustomerLocation::class, 'customer_id', 'customer_id');
    }
}

