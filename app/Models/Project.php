<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $table = 'projects';
    protected $fillable = [
        'id', 'name', 'start_date', 'end_date', 'description', 'seeker_profile_id', 'updated_at', 'created_at'
    ];
}
