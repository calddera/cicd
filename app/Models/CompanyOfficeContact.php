<?php

namespace App\Models;

use App\Models\CompanyOffice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class CompanyOfficeContact extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'company_office_contact_id';

    protected $fillable = [
        'company_office_id',
        'contact_name',
        'contact_address',
        'contact_phone_number',
        'contact_email',
        'is_active'
    ];

    public function companyOffice()
    {
        return $this->belongsTo(CompanyOffice::class, 'company_office_id', 'company_office_id');
    }
}
