<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    protected $table = 'educations';
    protected $fillable = [
        'id', 'school_name', 'major_id', 'start_date', 'end_date', 'seeker_profile_id', 'degree_id', 'updated_at', 'created_at'
    ];
}
