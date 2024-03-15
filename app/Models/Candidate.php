<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Candidate extends Authenticatable
{
    use HasFactory;
    // public $timestamps = false;//để không bị thêm  hai trường updated_at và created_at
    protected $table = 'candidate';
    protected $fillable = ['id', 'name', 'email', 'password','phone','user_image',
      'created_at', 'updated_at'];
}
