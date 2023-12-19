<?php

namespace App\Models;

use App\Models\Job;
use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory, SoftDeletes;


    protected $primaryKey = 'department_id';

    protected $fillable = [
        'company_id',
        'department_name',
        'is_active',
    ];


    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'company_id');
    }

    public function jobs()
    {
        return $this->hasMany(Job::class, 'department_id', 'department_id');
    }
}
