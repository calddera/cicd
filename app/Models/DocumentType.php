<?php

namespace App\Models;

use App\Models\Document;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentType extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'document_type_id';

    protected $fillable = [
        'document_type_name'
    ];

    public function documents()
    {
        return $this->hasMany(Document::class, 'document_type_id', 'document_type_id');
    }
}
