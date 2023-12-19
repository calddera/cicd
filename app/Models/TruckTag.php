<?php

namespace App\Models;

use App\Models\Truck;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class TruckTag extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'truck_tag_id';

    protected $fillable = [
        'truck_id',
        'tag_name',
        'valid_until'
    ];

    public function truck()
    {
        return $this->belongsTo(Truck::class, 'truck_id', 'truck_id');
    }
}
