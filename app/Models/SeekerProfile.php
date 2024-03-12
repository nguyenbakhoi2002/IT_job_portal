<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeekerProfile extends Model
{
    use HasFactory;
    protected $table = 'seeker_profile';
    protected $fillable = [
        'id', 'candidate_id', 'name', 'gender', 'date_of_birth', 'email', 'phone', 'address', 'link', 'image', 'updated_at', 'created_at'
    ];
}
