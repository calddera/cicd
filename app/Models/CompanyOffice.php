<?php

namespace App\Models;

use App\Models\Company;
use App\Models\CompanyOfficeContact;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class CompanyOffice extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'company_office_id';

    protected $fillable = [
        'company_id',
        'office_name',
        'office_address',
        'office_country',
        'office_state',
        'office_city',
        'office_zip_code',
        'office_lat',
        'office_lng',
        'is_active'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'company_id');
    }

    public function officeContacts()
    {
        return $this->hasMany(CompanyOfficeContact::class, 'company_office_id', 'company_office_id');
    }
}
