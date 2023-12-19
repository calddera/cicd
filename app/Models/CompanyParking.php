<?php

namespace App\Models;

use App\Models\Company;
use App\Models\Geofence;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompanyParking extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'company_parking_id';

    protected $fillable = [
        'company_id',
        'parking_name',
        'parking_address',
        'geofence_id'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'company_id');
    }

    public function geofence()
    {
        return $this->belongsTo(Geofence::class, 'geofence_id', 'geofence_id');
    }
}
