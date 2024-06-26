<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Skill extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    // public $timestamps = false;//để không bị thêm  hai trường updated_at và created_at
    protected $table = 'skills';
    protected $fillable = ['id', 'name', 'description', 'created_at', 'updated_at'];
    public function job_post(){
        return $this->belongsToMany(JobPost::class, 'job_post_skill','skill_id' ,'job_post_id')->withPivot('id');
    }
}
