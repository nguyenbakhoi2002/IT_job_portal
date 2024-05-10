<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class JobPost extends Model
{
    use HasFactory;
    protected $table = 'job_posts';
    protected $fillable = [
        'id', 'company_id', 'title','level', 'min_salary', 'max_salary', 'end_date', 'amount', 'type_work', 'description', 'requirement', 'benefits', 'area',
         'address', 'status','date_request', 'degree_id', 'time_exp_id', 'major_id','admin_id',  'created_at',    'updated_at'
        ];

    //truy xuất số lượng CV gửi về    
    public function activities(){
        // return $this->hasMany(JobPostActivity::class, 'job_post_id')
        //             ->selectRaw('job_post_id, count(*) as sum_profile')
        //             ->groupBy('job_post_id');
        return $this->hasMany(JobPostActivity::class, 'job_post_id');
    }    
    //hạn chế sử dụng DB:raw(các loại truy vấn thô, vì dễ bị tấn công sql)
    public function applied()
    {
        return $this->belongsToMany(SeekerProfile::class, 'job_post_activity', 'job_post_id', 'seeker_profile_id')->withPivot('id','seen', 'satisfy','created_at', 'updated_at')
                    ->select('seeker_profile.*', DB::raw('IF(job_post_activity.satisfy IS NULL OR job_post_activity.satisfy = "", 0, 
                    LENGTH(job_post_activity.satisfy) - LENGTH(REPLACE(job_post_activity.satisfy, "|", ""))+ 1)  AS satisfy_count'))
                    ->orderByDesc('satisfy_count');
    }
    //thông tin ứng viên
    public function seekerProfile(){
        return $this->belongsToMany(SeekerProfile::class, 'job_post_activity', 'job_post_id', 'seeker_profile_id')->withPivot('id','seen', 'satisfy', 'created_at', 'updated_at');
    }
    //lấy ra thông tin ứng viên đáp ứng được yêu cầu của bài đăng
    public function seekerProfileRequest($degreeLevel, $experienceYears, $jobPostSkills){
        return $this->seekerProfile()
                    ->when($degreeLevel, function ($query)  use ($degreeLevel){//when để nếu yêu cầu bằng cấp > 0 mới thực hiện where
                        return $query->whereHas('educations', function ( $query) use ($degreeLevel){
                                        $query->join('degree', 'educations.degree_id', '=', 'degree.id')
                                            ->groupBy('seeker_profile_id')
                                            ->havingRaw('MAX(level) >= ?',[$degreeLevel] );
                                    
                                    });
                    })
                    ->when($experienceYears, function ($query)  use ($experienceYears){//when để nếu yêu cầu kinh nghiệm > 0 mới thực hiện where
                        return $query->whereHas('experiences', function ($query) use ($experienceYears){
                                        $query->groupBy('seeker_profile_id')
                                            ->havingRaw('SUM(DATEDIFF(IFNULL(end_date, CURDATE()), start_date) / 365) >= ?',[$experienceYears] );
                                    });
                    })
                    ->whereHas('skills', function ($query) use ($jobPostSkills) {
                        $query->whereIn('skill_id', $jobPostSkills);
                    }, '=', count($jobPostSkills));
        
    }

    //thông tin kĩ năng có trong bài đăng
    public function skills(){
        return $this->belongsToMany(Skill::class, 'job_post_skill', 'job_post_id', 'skill_id');
    }
    //thong tin ngoại ngữ
    public function languages(){
        return $this->belongsToMany(Language::class, 'job_post_language', 'job_post_id', 'language_id')->withPivot('level');
    }
    //lấy ra bằng cấp và kinh nghiệm yêu cầu
    public function degree(){
        return $this->belongsTo(Degree::class, 'degree_id');
    }
    public function experience(){
        return $this->belongsTo(TimeExperience::class, 'time_exp_id');
    }
    //lấy ra chuyên ngành
    public function major(){
        return $this->belongsTo(Major::class, 'major_id');
    }
    //lây ra công ty mà bài đăng thuộc về
    public function company(){
        return $this->belongsTo(Company::class, 'company_id');
    }
}
