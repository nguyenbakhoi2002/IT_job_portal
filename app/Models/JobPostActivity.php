<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPostActivity extends Model
{
    use HasFactory;
    // public $timestamps = false;
    protected $table = 'job_post_activity';
    protected $fillable = [
        'id', 'seeker_profile_id', 'job_post_id','seen', 'satisfy','company_id', 'created_ad', 'updated_ad'
    ]; 
    public function jobPost(){
        return $this->belongsTo(JobPost::class, 'job_post_id');
    }
    public function seeker(){
        return $this->belongsTo(SeekerProfile::class, 'seeker_profile_id');
    }
}
