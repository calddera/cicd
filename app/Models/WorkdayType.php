<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkdayType extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'workday_type_id';

    protected $fillable = [
        'workday_type_name',
        'workday_description_name',
    ];

}
