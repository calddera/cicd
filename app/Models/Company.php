<?php

namespace App\Models;

use App\Models\CostCenter;
use App\Models\Department;
use App\Models\CompanyOffice;
use App\Models\CompanyParking;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'company_id';

    protected $fillable = [
        'company_name',
        'employer_register',
        'RFC',
        'employer_representative',
        'legal_representative',
        'tax_residence',
        'is_active'
    ];

    public function companyOffices()
    {
        return $this->hasMany(CompanyOffice::class, 'company_id', 'company_id');
    }

    public function companyParkings()
    {
        return $this->hasMany(CompanyParking::class, 'company_id', 'company_id');
    }

    public function departments()
    {
        return $this->hasMany(Department::class, 'company_id', 'company_id');
    }

    public function costCenters()
    {
        return $this->hasMany(CostCenter::class, 'company_id', 'company_id');
    }
}
