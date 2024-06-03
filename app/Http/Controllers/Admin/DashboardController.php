<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Candidate;
use App\Models\SeekerProfile;
use App\Models\Admin;
use App\Models\Skill;
use App\Models\Major;
use App\Models\JobPost;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(){
        $candidate = Candidate::all();
        $company = Company::where('status', '<>', 0)->get();
        $job_post = JobPost::where('status', 1)->where('end_date', '>=', now())->get();
        $seekerProfile = SeekerProfile::where('is_clone', 0)->get();
        $admin = Admin::all();
        $skill = Skill::all();
        $major = Major::all();
        $company_wait=Company::where('status', 0)->get();
        $post_wait=JobPost::where('status', 3)->get();


        //chart
        $chart_data = [];
        $chart_data_candidate = [];
        $chart_data_post = [];
        $end_date = Carbon::now()->toDateString();
        $start_date = Carbon::now()->subDays(7)->toDateString();
        $get=Company::whereRaw('DATE(created_at) BETWEEN ? AND ?', [$start_date, $end_date])
        // ->whereBetween('created_at', [$sdate, $edate])
        ->orderBy('created_at', 'ASC')
        ->groupByRaw('DATE(created_at)')
        ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
        ->get();
        foreach($get as $value){
            $chart_data[] = array(
                'period' =>$value->date,
                'total_company'=>$value->count,
            );
        }

        $data_company = json_encode($chart_data);
        $get=Candidate::whereRaw('DATE(created_at) BETWEEN ? AND ?', [$start_date, $end_date])
        ->orderBy('created_at', 'ASC')
        ->groupByRaw('DATE(created_at)')
        ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
        ->get();
        foreach($get as $value){
            $chart_data_candidate[] = array(
                'period' =>$value->date,
                'total_candidate'=>$value->count,
            );
        }
        $data_candidate = json_encode($chart_data_candidate);
        $get=JobPost::whereRaw('DATE(allow_date) BETWEEN ? AND ?', [$start_date, $end_date])
        ->orderBy('allow_date', 'ASC')
        ->groupByRaw('DATE(allow_date)')
        ->selectRaw('DATE(allow_date) as date, COUNT(*) as count')
        ->get();
        foreach($get as $value){
            $chart_data_post[] = array(
                'period' =>$value->date,
                'total_post'=>$value->count,
            );
        }
        $data_post = json_encode($chart_data_post);
        

        return view('admin.dashboard', ['candidate' => $candidate, 'company' => $company,
         'seekerProfile' => $seekerProfile, 'admin' => $admin, 'skill' => $skill, 'major' =>$major,
          'company_wait' => $company_wait, 'post_wait' => $post_wait , 'job_post'=>$job_post, 'sdate'=>$start_date, 'edate'=>$end_date,
            'data_company'=>$data_company, 'data_candidate'=>$data_candidate, 'data_post'=>$data_post
        ]);
    }
    public function chartCompany(Request $request){
        // $company = auth('company')->user();
        $data = $request->all();
        $start_date=$data['startDate'];
        $end_date=$data['endDate'];
        $get=Company::whereRaw('DATE(created_at) BETWEEN ? AND ?', [$start_date, $end_date])
        // ->whereBetween('created_at', [$start_date, $end_date])
        ->orderBy('created_at', 'ASC')
        ->groupByRaw('DATE(created_at)')
        ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
        ->get();
        
        foreach($get as $value){
            // $total_post=JobPost::where('company_id', $company->id)->whereBetween('allow_date', $value->allowdate)->orderBy('allow_date', 'ASC')->get();
            $chart_data[] = array(
                'period' =>$value->date,
                'total_company'=>$value->count,
            );
        }
        echo $data = json_encode($chart_data);
    }
    public function chartCandidate(Request $request){
        // $company = auth('company')->user();
        $data = $request->all();
        $start_date=$data['startDate'];
        $end_date=$data['endDate'];
        $get=Candidate::whereRaw('DATE(created_at) BETWEEN ? AND ?', [$start_date, $end_date])
        ->orderBy('created_at', 'ASC')
        ->groupByRaw('DATE(created_at)')
        ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
        ->get();
        
        foreach($get as $value){
            // $total_post=JobPost::where('company_id', $company->id)->whereBetween('allow_date', $value->allowdate)->orderBy('allow_date', 'ASC')->get();
            $chart_data[] = array(
                'period' =>$value->date,
                'total_candidate'=>$value->count,
            );
        }
        echo $data = json_encode($chart_data);
    }
    public function chartPost(Request $request){
        // $company = auth('company')->user();
        $data = $request->all();
        $start_date=$data['startDate'];
        $end_date=$data['endDate'];
        $get=JobPost::whereRaw('DATE(allow_date) BETWEEN ? AND ?', [$start_date, $end_date])
        ->orderBy('allow_date', 'ASC')
        ->groupByRaw('DATE(allow_date)')
        ->selectRaw('DATE(allow_date) as date, COUNT(*) as count')
        ->get();
        
        foreach($get as $value){
            // $total_post=JobPost::where('company_id', $company->id)->whereBetween('allow_date', $value->allowdate)->orderBy('allow_date', 'ASC')->get();
            $chart_data[] = array(
                'period' =>$value->date,
                'total_post'=>$value->count,
            );
        }
        echo $data = json_encode($chart_data);
    }
}
