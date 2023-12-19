<?php

namespace App\Models;

use App\Models\DocumentType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'document_id';

    protected $fillable = [
        'document_name',
        'document_type_id',
        'is_mandatory',
    ];

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class, 'document_type_id', 'document_type_id');
    }
}
