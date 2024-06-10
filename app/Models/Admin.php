<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
    use HasFactory;
    // use SoftDeletes;
    // protected $dates = ['deleted_at'];

    protected $table = 'admin';
    protected $fillable = ['id','name', 'email', 'password','phone', 'address','created_at', 'updated_at', 'type', 'image'];
}
