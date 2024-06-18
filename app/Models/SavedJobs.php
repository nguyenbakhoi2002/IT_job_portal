<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedJobs extends Model
{
    use HasFactory;
    // use SoftDeletes;
    // protected $dates = ['deleted_at'];
    // public $timestamps = false;//để không bị thêm  hai trường updated_at và created_at
    protected $table = 'saved_jobs';
    protected $fillable = ['id', 'candidate_id', 'job_post_id', 'created_at', 'updated_at'];
    public function jobPost(){
        return $this->belongsTo(JobPost::class, 'job_post_id');
    }
    public function seeker(){
        return $this->belongsTo(SeekerProfile::class, 'seeker_profile_id');
    }
}
