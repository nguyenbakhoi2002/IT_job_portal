<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class TimeExperience extends Model
{
    use HasFactory;
    //use SoftDeletes;
    // protected $dates = ['deleted_at'];
    // public $timestamps = false;//để không bị thêm  hai trường updated_at và created_at
    protected $table = 'time_exp';
    protected $fillable = ['id', 'name', 'level', 'created_at', 'updated_at'];
}
