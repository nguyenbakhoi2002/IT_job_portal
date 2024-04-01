<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeekerSkill extends Model
{
    use HasFactory;
    protected $table = 'seeker_skill';
    protected $fillable = [
        'id', 'seeker_profile_id', 'skill_id', 'updated_at', 'created_at'
    ];
    
}
