<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EloTeam extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'elo_team_id';

    protected $fillable = [
        'elo_team_name',
        'is_active'
    ];

    protected $dates = [
        'deleted_at'
    ];

}
