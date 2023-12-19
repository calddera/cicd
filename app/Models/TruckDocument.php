<?php

namespace App\Models;

use App\Models\User;
use App\Models\Truck;
use App\Models\Document;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TruckDocument extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $primaryKey = 'truck_document_id';

    protected $fillable = [
        'truck_id',
        'document_id',
        'file_name',
        'file_path',
        'is_active',
        'valid_until',
        'created_by',
        'updated_by'
    ];

    public function truck()
    {
        return $this->belongsTo(Truck::class, 'truck_id', 'truck_id');
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
