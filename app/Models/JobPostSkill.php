<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPostSkill extends Model
{
    use HasFactory;
    // use SoftDeletes;
    // protected $dates = ['deleted_at'];
    public $timestamps = false;//để không bị thêm  hai trường updated_at và created_at
    protected $table = 'job_post_skill';
    protected $fillable = ['id', 'job_post_id', 'skill_id'];
}
