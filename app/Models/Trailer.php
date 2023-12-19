<?php

namespace App\Models;

use App\Models\User;
use App\Models\TrailerTire;
use App\Models\TrailerType;
use App\Models\TrailerModel;
use App\Models\TrailerPlate;
use App\Models\VehicleStatus;
use App\Models\TrailerDocument;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trailer extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $primaryKey = 'trailer_id';

    protected $fillable = [
        'unit_number',
        'vin_number',
        'vehicle_status_id',
        'trailer_type_id',
        'is_active',
        'trailer_model_id',
        'trademark',
        'IMAI',
        'created_by',
        'updated_by'
    ];

    public function vehicleStatus()
    {
        return $this->belongsTo(VehicleStatus::class, 'vehicle_status_id', 'vehicle_status_id');
    }

    public function trailerType()
    {
        return $this->belongsTo(TrailerType::class, 'trailer_type_id', 'trailer_type_id');
    }

    public function trailerModel()
    {
        return $this->belongsTo(TrailerModel::class, 'trailer_model_id', 'trailer_model_id');
    }

    public function trailerTires()
    {
        return $this->hasMany(TrailerTire::class, 'trailer_id', 'trailer_id');
    }

    public function trailerPlates()
    {
        return $this->hasMany(TrailerPlate::class, 'trailer_id', 'trailer_id');
    }

    public function currentPlate()
    {
        return $this->hasOne(TrailerPlate::class, 'trailer_id', 'trailer_id')->ofMany([
            'created_at' => 'max'
        ], function ($query) {
            $query->where('is_active', '=', 1);
        });
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'user_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'user_id');
    }

    public function trailerDocuments()
    {
        return $this->hasMany(TrailerDocument::class, 'trailer_id', 'trailer_id');
    }


}
