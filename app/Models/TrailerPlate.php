<?php

namespace App\Models;

use App\Models\User;
use App\Models\Trailer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrailerPlate extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $primaryKey = 'trailer_plate_id';

    protected $fillable = [
        'trailer_id',
        'plate_country',
        'plate_code',
        'plate_expires_at',
        'plate_photo',
        'is_active'
    ];

    public function trailer()
    {
        return $this->belongsTo(Trailer::class, 'trailer_id', 'trailer_id');
    }
}
