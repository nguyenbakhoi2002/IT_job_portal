<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Company extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    // public $timestamps = false;//để không bị thêm  hai trường updated_at và created_at
    protected $table = 'companies';
    protected $fillable = ['id', 'company_name', 'name', 'email', 'password', 'address','phone', 'logo',
     'company_model','status', 'created_at', 'updated_at', 'working_time',
     'link_web', 'tax_code','image_paper', 'team','map', 'about','founded_in', 'token'];
     public function jobPost(){
        return $this->hasMany(JobPost::class, 'company_id')->where('status', 1);
     }
     public function seekerProfile(){
      return $this->belongsToMany(SeekerProfile::class, 'job_post_activity', 'company_id', 'seeker_profile_id')
      ->orderBy('job_post_activity.id', 'desc')
      ->withPivot('id','seen', 'satisfy','job_post_id' ,'created_at', 'updated_at');
    }
    public function saved_candidates(){
      return $this->belongsToMany(Candidate::class, 'saved_candidates', 'company_id', 'candidate_id')
      ->where('status', 1)
      ->withPivot('created_at', 'updated_at');
    }
    public function saved_candidates_search($key){
      return $this->belongsToMany(Candidate::class, 'saved_companies', 'company_id', 'candidate_id')
      ->where('status', 1)
      ->where('name', 'like', '%'.$key.'%')
      ->withPivot('created_at', 'updated_at');
    }
    //những người lưu công ty
    public function nguoi_luu_congty(){
      return $this->belongsToMany(Candidate::class, 'saved_companies', 'company_id', 'candidate_id')
      ->withPivot('created_at', 'updated_at');
    }
}
