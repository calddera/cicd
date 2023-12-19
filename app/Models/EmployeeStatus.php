<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeStatus extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'employee_status_id';

    protected $fillable = [
        'employee_status_name'
    ];

}
