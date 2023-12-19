<?php

namespace App\Models;

use App\Models\Trailer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrailerType extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'trailer_type_id';

    protected $fillable = [
        'trailer_type_name'
    ];

    public function trailers()
    {
        return $this->hasMany(Trailer::class, 'trailer_type_id', 'trailer_type_id');
    }
}
