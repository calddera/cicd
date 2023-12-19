<?php

namespace App\Models;

use App\Models\User;
use App\Models\Trailer;
use App\Models\Document;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TrailerDocument extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $primaryKey = 'trailer_document_id';

    protected $fillable = [
        'trailer_id',
        'document_id',
        'file_name',
        'file_path',
        'is_active',
        'valid_until',
        'created_by',
        'updated_by'
    ];

    public function trailer()
    {
        return $this->belongsTo(Trailer::class, 'trailer_id', 'trailer_id');
    }

    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id', 'document_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'user_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'user_id');
    }
}
