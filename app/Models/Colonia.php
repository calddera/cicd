<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colonia extends Model
{
    use HasFactory;


    protected $fillable = [
        'company_name',
        'employer_register',
        'RFC',
        'employer_representative',
        'legal_representative',
        'tax_residence',
        'is_active'
    ];
}
