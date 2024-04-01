<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobPost;
use App\Models\Major;
use App\Models\Skill;
use App\Models\TimeExperience;
use Carbon\Carbon;
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
        // dd($current_date->diff($end_date)->days);
        $data = JobPost::where('end_date', '>', $current_date)->where('status', 1)->paginate(12);
        $exp = TimeExperience::all();
        $major = Major::all();
        $skill = Skill::all();
        return view('client/post/job-list', 
        ['data'=>$data, 'major'=>$major, 'skill'=>$skill, 'dataProvinces'=>$dataProvinces, 'current_date'=>$current_date,
         'exp'=>$exp
        ]);
    }
    public function detail(JobPost $job){
        $job = $job;
        $dataProvinces = getProvinceByJSON();
        $current_date = Carbon::now();

        // dd($dataProvinces);
        $data_job_relate = JobPost::where('major_id', $job->major_id)->where('id', '!=', $job->id)->take(10)->get();
        return view('client/post/job-detail', 
        ['data_job' => $job, 'data_job_relate'=>$data_job_relate, 'dataProvinces'=>$dataProvinces, 'current_date'=>$current_date]);
    }
}
