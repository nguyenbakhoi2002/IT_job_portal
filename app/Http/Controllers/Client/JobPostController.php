<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobPost;
use App\Models\Major;
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
        $data = JobPost::where('end_date', '>=', $current_date_string)->where('status', 1)->paginate(12);
        $exp = TimeExperience::all();
        $major = Major::all();
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
        $data_job_relate = JobPost::where('major_id', $job->major_id)->where('id', '!=', $job->id)->take(10)->get();
        return view('client/post/job-detail', 
        ['data_job' => $job, 'data_job_relate'=>$data_job_relate, 'dataProvinces'=>$dataProvinces, 'current_date'=>$current_date,
            'check_applied' => $check_applied, 'check_profile' => $check_profile
        ]);
    }
}
