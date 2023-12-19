<?php

namespace App\Models;

use App\Models\Trailer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrailerModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'trailer_model_id';

    protected $fillable = [
        'trailer_model_name',
    ];

    public function trailers()
    {
        return $this->hasMany(Trailer::class, 'trailer_model_id', 'trailer_model_id');
    }
}
