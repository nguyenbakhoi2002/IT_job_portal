<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;
    protected $table = 'experiences';
    protected $fillable = [
        'id', 'company_name', 'work_position', 'start_date', 'end_date', 'seeker_profile_id', 'updated_at', 'created_at'
    ];
}
