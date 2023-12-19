<?php
// app/Models/CustomerStatus.php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerStatus extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'customer_status_id';
    protected $fillable = [
        'customer_status_name'
    ];

    public function customers()
    {
        return $this->hasMany(Customer::class, 'customer_id', 'customer_id');
    }
}

