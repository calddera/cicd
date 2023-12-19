<?php

namespace App\Models;

use App\Models\Truck;
use App\Models\Job;
use App\Models\DriverTruck;
use App\Models\EmployeeStatus;
use App\Models\EmployeeDocument;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'employee_id';

    protected $fillable = [
        'employee_id',
        'first_name',
        'first_surname',
        'second_surname',
        'gender',
        'NSS',
        'RFC',
        'CURP',
        'contract_type_id',
        'salary_type_id',
        'workday_type_id',
        'SDI',
        'hire_date',
        'birth_date',
        'job_id',
        'UMF',
        'nationality',
        'birth_country',
        'birth_state_code',
        'birth_city',
        'address_country',
        'address_state_code',
        'address_city',
        'address_zipcode',
        'address_description',
        'address_lat',
        'address_lng',
        'marital_status',
        'employee_status_id',
        'elo_team_id',
        'cost_center_id',
        'email',
        'last_updated_by',
        'last_updated_on',
        'phone_number',
        'image'
    ];

    public function trucks()
    {
        return $this->belongsToMany(Truck::class, 'driver_truck', 'employee_id', 'truck_id')
            ->using(DriverTruck::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id', 'job_id');
    }

    public function status()
    {
        return $this->belongsTo(EmployeeStatus::class, 'employee_status_id', 'employee_status_id');
    }

    public function documents()
    {
        return $this->hasMany(EmployeeDocument::class, 'employee_id', 'employee_id');
    }
}
