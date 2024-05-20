<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobPostActivity;
use App\Models\JobPost;
use App\Models\Company;
use App\Models\Candidate;
use App\Models\Skill;
use App\Models\TimeExperience;
use App\Models\Major;
use Carbon\Carbon;
use DB;


class HomeController extends Controller
{
    public function index(){
        //lấy json
        $jsonFilePath = storage_path('app\json\provinces.json');
        //đọc nội dung của tập tin json
        $jsonContent = file_get_contents($jsonFilePath);
        //chuyển đổi json thành mảng
        $dataProvinces = json_decode($jsonContent, true);
        $current_date =Carbon::now();
        $job = JobPost::where('status', 1)->whereDate('end_date', '>', Carbon::now())->get();
        $job_post_activities =JobPostActivity::all();
        $candidate = Candidate::all();
        $company = Company::where('status', 1)->get();
        $major_popular_ids = Major::select('majors.id as id','majors.name as major_name', DB::raw('COUNT(job_posts.id) as total_posts'))
        ->join('job_posts', 'job_posts.major_id', '=', 'majors.id')
        ->where('job_posts.status', 1)
        ->where('job_posts.end_date', '>', now())
        ->groupBy('majors.name', 'majors.id')
        ->orderByDesc('total_posts')
        ->take(6)
        ->pluck('majors.id')
        ->toArray();
        $major_popular = Major::whereIn('id', $major_popular_ids)->get();

        $job_popular_ids = JobPost::select('job_posts.id as id','job_posts.title as title','company_name', 
        'logo','job_posts.address as address','min_salary', 'max_salary', 'end_date',
         DB::raw('COUNT(job_posts.id) as total_profile'))
        ->join('job_post_activity', 'job_posts.id', '=', 'job_post_activity.job_post_id')
        ->join('companies', 'job_posts.company_id', '=', 'companies.id')
        ->where('job_posts.end_date', '>', Carbon::now())
        ->groupBy('job_posts.title', 'job_posts.id', 'logo', 'job_posts.address', 'company_name', 'min_salary', 'max_salary', 'end_date')
        ->orderByDesc('total_profile')
        ->take(6)
        ->pluck('job_posts.id')
        ->toArray();
        //cái này chỉ nên lấy ra id thôi, xong ở dưới cùng model find những cái có id như vâyj
        // dd($job_popular);
        $job_popular = JobPost::whereIn('id', $job_popular_ids)->get();
        if(request()->area || request()->name){
            $data_ids = JobPost::join('companies', 'job_posts.company_id', '=', 'companies.id')
            ->where(function ($q){
                $search = request()->name;
                $area =request()->area;
                if (!empty($search)) {
                    $q->orwhere('job_posts.title', 'LIKE', '%' . $search . '%')
                    ->orwhere('companies.name', 'LIKE', '%' . $search . '%');
                }
                if (!empty($area)) {
                    $q->where('job_posts.area', '=', $area);
                }
            })
            ->select('job_posts.*')
            ->distinct()
            ->with(['job_post.company', 'job_post.major'])
            ->pluck('job_posts.id')
            ->toArray();
            $data = JobPost::whereIn('id', $data_ids)->where('end_date', '>=', Carbon::now())->where('status', 1)->paginate(12);
            $exp = TimeExperience::all();
            $major = Major::all();
            $skill = Skill::all();
            return view('client/post/job-list', 
            ['data'=>$data, 'major'=>$major, 'skill'=>$skill, 'dataProvinces'=>$dataProvinces, 'current_date'=>$current_date,
             'exp'=>$exp
            ]);
        }

        return view('client.home', ['job'=>$job, 'candidate'=>$candidate, 
        'job_post_activities'=>$job_post_activities, 'company'=>$company,
        'major_popular'=>$major_popular, 'job_popular'=>$job_popular, 'current_date'=>$current_date,  'dataProvinces'=>$dataProvinces
        ]);
    }
    public function choose(){
        return view('client.choose');
    }
    public function contact(){
        return view('client.contact');
    }
    public function clientBlock(){
        return view('client.block', ['title'=>'Cảnh báo']);
    }
}
