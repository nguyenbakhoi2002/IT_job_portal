<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Foundation\Auth\User as Authenticatable;


class Candidate extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    // public $timestamps = false;//để không bị thêm  hai trường updated_at và created_at
    protected $table = 'candidate';
    protected $fillable = ['id', 'name', 'email', 'password','phone','user_image',
      'created_at', 'updated_at', 'token', 'google_id'];
      public function seekerProfile(){
        return $this->hasMany(SeekerProfile::class, 'candidate_id');
     }
     public function seekerProfileMain(){
      return $this->hasOne(SeekerProfile::class, 'candidate_id')->where('is_clone', 0);
   }
     public function saved_jobs(){
      return $this->belongsToMany(JobPost::class, 'saved_jobs', 'candidate_id', 'job_post_id')
      ->where('status', 1)
      ->where('end_date', '>', now())
      ->whereHas('company', function ($query) {
        $query->where('status', 1);
      })
      ->withPivot('created_at', 'updated_at');
    }
    public function saved_companies(){
      return $this->belongsToMany(Company::class, 'saved_companies', 'candidate_id', 'company_id')
      ->where('status', 1)
      ->withPivot('created_at', 'updated_at');;
    }
    
}
