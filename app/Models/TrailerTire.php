<?php

namespace App\Models;

use App\Models\Trailer;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrailerTire extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $primaryKey = 'trailer_tire_id';

    protected $fillable = [
        'trailer_id',
        'buy_date',
        'buy_price',
        'serial_number',
        'is_active',
    ];

    public function trailer()
    {
        return $this->belongsTo(Trailer::class, 'trailer_id', 'trailer_id');
    }
}
