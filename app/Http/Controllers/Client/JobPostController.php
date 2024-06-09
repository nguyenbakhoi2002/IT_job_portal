<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobPost;
use App\Models\Major;
use App\Models\Company;
use App\Models\Skill;
use App\Models\TimeExperience;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
//
// use App\Helpers\CommonHelper;


class JobPostController extends Controller
{
    public function index(){
        //lấy json
        $jsonFilePath = storage_path('app\json\provinces.json');
        //đọc nội dung của tập tin json
        $jsonContent = file_get_contents($jsonFilePath);
        //chuyển đổi json thành mảng
        $dataProvinces = json_decode($jsonContent, true);

        // $current_date->diff($item->end_date)->days
        $current_date = Carbon::now();
        $current_date_string = Carbon::now()->toDateString();
        // dd($current_date->diff($end_date)->days);
        $data = JobPost::where('end_date', '>=', $current_date_string)
                        ->where('status', 1)
                        ->whereHas('company', function($query) {
                            $query->where('status', 1)
                            ->where('deleted_at', NULL);
                        })
                        ->paginate(12);
        if(request()->major || request()->skill || request()->exp || request()->area || request()->name ||request()->wage){
            $data_ids = Skill::join('job_post_skill', 'skills.id', '=', 'job_post_skill.skill_id')
            ->join('job_posts', 'job_post_skill.job_post_id', '=', 'job_posts.id')
            ->join('companies', 'job_posts.company_id', '=', 'companies.id')
            ->where(function ($q){
                $search = request()->name;
                $major = request()->major;
                $wage = request()->wage;
                // $type = $request['searchType'];
                $exp = request()->exp;
                $area =request()->area;
                $skill = request()->skill;
                if (!empty($search)) {
                    $q->orwhere('job_posts.title', 'LIKE', '%' . $search . '%');
                    // ->orwhere('companies.name', 'LIKE', '%' . $search . '%');
                }
                if (!empty($area)) {
                    $q->where('job_posts.area', '=', $area);
                }
                if (!empty($exp)) {
                    $q->where('job_posts.time_exp_id', '=', $exp);
                }
                if (!empty($skill)) {
                    $q->where('skills.id', '=', $skill);
                }
                if (!empty($major)) {
                    $q->where('job_posts.major_id', '=', $major);
                }
                if (!empty($wage)) {
                    $wageConfig = config('custom.wage')[$wage];
                    $minSalary = $wageConfig['min'];
                    $maxSalary = $wageConfig['max'];

                    $q->where(function ($query) use ($minSalary, $maxSalary) {
                        $query
                            ->whereBetween('job_posts.min_salary', [$minSalary, $maxSalary])
                            ->orWhereBetween('job_posts.max_salary', [$minSalary, $maxSalary]);


                    });
                    // $q->where(function ($query) use ($minSalary, $maxSalary) {
                    //     $query->where(function ($q) use ($minSalary, $maxSalary) {
                    //         $q->where('job_posts.min_salary', '>=', $minSalary)
                    //           ->where('job_posts.min_salary', '<=', $maxSalary);
                    //     })->orWhere(function ($q) use ($minSalary, $maxSalary) {
                    //         $q->where('job_posts.max_salary', '>=', $minSalary)
                    //           ->where('job_posts.max_salary', '<=', $maxSalary);
                    //     });
                    // });
                }
                // if (!empty($type)) {
                //     $q->where('job_posts.type_work', '=', $type);
                // }
                
            })
            ->select('job_posts.*')
            ->distinct()
            ->with(['job_post.company', 'job_post.major'])
            ->pluck('job_posts.id')
            ->toArray();
            // dd($data_ids);
            $data = JobPost::whereIn('id', $data_ids)
                            ->where('end_date', '>=', $current_date_string)
                            ->where('status', 1)
                            ->whereHas('company', function($query) {
                                $query->where('status', 1);
                            })
                            ->paginate(12);
        }
        $exp = TimeExperience::where('status', 1)->get();
        $major = Major::where('status', 1)->get();
        $skill = Skill::all();
        return view('client/post/job-list', 
        ['data'=>$data, 'major'=>$major, 'skill'=>$skill, 'dataProvinces'=>$dataProvinces, 'current_date'=>$current_date,
         'exp'=>$exp
        ]);
    }
    public function detail(JobPost $job){
        //check xem đã ứng tuyển chưa;
        $check_applied = 0;
        //check xem đã tạo profile không;
        $check_profile = 0; 
        $job = $job;
        $dataProvinces = getProvinceByJSON();
        $current_date = Carbon::now();
        if(auth('candidate')->user()){
            //lấy ra id của tài khoản đang đăng nhập
            $client = auth('candidate')->user();
            //lấy ra mảng các prolife của tài khoản hiện tại
            $client_profile = $client->seekerProfile()->pluck('id')->toArray();
            //lấy ra mảng các profile ứng tuyển
            $job_profile=$job->seekerProfile()->pluck('seeker_profile_id')->toArray();
            //kiểm tra xem có profile nào của ứng viên hiện tại ứng tuyển ko
            //nếu trả về 1 mảng lớn hơn 1 phần tử chứng tỏ đang apply
            //array_intersect trả về mảng chứa các phần tử chung
            $check_applied = count(array_intersect($client_profile, $job_profile));
            //lấy ra profile chính
            $check_profile = count($client->seekerProfile()->where('is_clone', 0)->get());
            
        // dd(count($check_applied));

        }
        
        // dd(count($check_applied));
        // dd($dataProvinces);
        $data_job_relate = JobPost::where('major_id', $job->major_id)
                                    ->where('id', '!=', $job->id)
                                    ->where('status', 1)
                                    ->where('end_date', '>', Carbon::now())
                                    ->whereHas('company', function($query) {
                                        $query->where('status', 1);
                                    })
                                    ->take(10)->get();
        return view('client/post/job-detail', 
        ['data_job' => $job, 'data_job_relate'=>$data_job_relate, 'dataProvinces'=>$dataProvinces, 'current_date'=>$current_date,
            'check_applied' => $check_applied, 'check_profile' => $check_profile
        ]);
    }
}
