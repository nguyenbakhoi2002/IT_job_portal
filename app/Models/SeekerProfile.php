<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeekerProfile extends Model
{
    use HasFactory;
    protected $table = 'seeker_profile';
    protected $fillable = [
        'id', 'candidate_id', 'name', 'gender', 'date_of_birth', 'email', 'phone','title','objective', 'address', 'link', 'image','total_experience', 'updated_at', 'created_at'
    ];
    public function educations(){
        return $this->hasMany(Education::class, 'seeker_profile_id');
    }
    public function experiences(){
        return $this->hasMany(Experience::class, 'seeker_profile_id');
    }
    public function projects(){
        return $this->hasMany(Project::class, 'seeker_profile_id');
    }
    public function skills(){
        return $this->belongsToMany(Skill::class, 'seeker_skill', 'seeker_profile_id', 'skill_id');
    }
    public function languages(){
        return $this->belongsToMany(Language::class, 'seeker_language', 'seeker_profile_id', 'language_id');
    }
    public function candidate(){
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }
}
