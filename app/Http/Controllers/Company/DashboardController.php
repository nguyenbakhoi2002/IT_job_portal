<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use DB;
use App\Models\JobPost;
use App\Models\JobPostActivity;


class DashboardController extends Controller
{
    public function index(){
        $title = 'Dashboard';  
        $company = auth('company')->user();
        //tổng số tin tuyển dụng
        $list_job = $company->jobPost;
        //tổng số ứng tuyển 
        $count_applied =0;
        foreach($list_job as $item){
            $count_applied += count($item->seekerProfile);
        }
        // biểu đồ
        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subDay(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subDay(365)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $getpost=JobPost::where('company_id', $company->id)->whereBetween('allow_date', [$sub7days, $now])
        ->orderBy('allow_date', 'ASC')
        ->groupByRaw('DATE(allow_date)')
        ->selectRaw('DATE(allow_date) as date, COUNT(*) as count')
        ->get();
        foreach($getpost as $value){
            $chart_data_post[] = array(
                'period' =>$value->date,
                'total_post'=>$value->count,
            );
        }

        $get=JobPostActivity::where('company_id', $company->id)->whereBetween('created_at', [$sub7days, $now])
            ->orderBy('created_at', 'ASC')
            ->groupByRaw('DATE(created_at)')
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->get();
        foreach($get as $value){
            $chart_data[] = array(
                'period' =>$value->date,
                'total_cv'=>$value->count,
            );
        }
        $data_post = json_encode($chart_data_post);
        // dd($data_post);
        $data = json_encode($chart_data);




        return view('company.dashboard', 
        ['title' => $title, 'list_job' => $list_job, 'count_applied' => $count_applied, 'activeRoute'=>'dashboard', 'data' => $data, 'data_post'=>$data_post]);
    }
    public function chart(Request $request){
        $company = auth('company')->user();
        $data = $request->all();
        $dau_thang_nay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateTimeString();
        $dau_thang_truoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateTimeString();
        $cuoi_thang_truoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateTimeString();
        //
        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subDay(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subDay(365)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        if($data['dashboard_value']=='7ngay'){
            $get=JobPost::where('company_id', $company->id)->whereBetween('allow_date', [$sub7days, $now])
            ->orderBy('allow_date', 'ASC')
            ->groupByRaw('DATE(allow_date)')
            ->selectRaw('DATE(allow_date) as date, COUNT(*) as count')
            ->get();
        }
        elseif($data['dashboard_value']=='thangtruoc'){
            $get=JobPost::where('company_id', $company->id)->whereBetween('allow_date', [$dau_thang_truoc, $cuoi_thang_truoc])
            ->orderBy('allow_date', 'ASC')
            ->groupByRaw('DATE(allow_date)')
            ->selectRaw('DATE(allow_date) as date, COUNT(*) as count')
            ->get();
        }
        else{
            $get=JobPost::where('company_id', $company->id)->whereBetween('allow_date', [$dau_thang_nay, $now])
            ->orderBy('allow_date', 'ASC')
            ->groupByRaw('DATE(allow_date)')
            ->selectRaw('DATE(allow_date) as date, COUNT(*) as count')
            ->get();
        }
        // else{
        //     $get=JobPost::whereBetween('allow_date', [$sub365days, $now])->orderBy('allow_date', 'ASC')->get();
        // }
        foreach($get as $value){
            // $total_post=JobPost::where('company_id', $company->id)->whereBetween('allow_date', $value->allowdate)->orderBy('allow_date', 'ASC')->get();
            $chart_data[] = array(
                'period' =>$value->date,
                'total_post'=>$value->count,
            );
        }
        echo $data = json_encode($chart_data);
    }
    public function chartCv(Request $request){
        $company = auth('company')->user();
        $data = $request->all();
        $dau_thang_nay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateTimeString();
        $dau_thang_truoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateTimeString();
        $cuoi_thang_truoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateTimeString();
        //
        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subDay(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subDay(365)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        if($data['dashboard_value']=='7ngay'){
            $get=JobPostActivity::where('company_id', $company->id)->whereBetween('created_at', [$sub7days, $now])
            ->orderBy('created_at', 'ASC')
            ->groupByRaw('DATE(created_at)')
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->get();
        }
        elseif($data['dashboard_value']=='thangtruoc'){
            $get=JobPostActivity::where('company_id', $company->id)->whereBetween('created_at', [$dau_thang_truoc, $cuoi_thang_truoc])
            ->orderBy('created_at', 'ASC')
            ->groupByRaw('DATE(created_at)')
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->get();
        }
        else{
            $get=JobPostActivity::where('company_id', $company->id)->whereBetween('created_at', [$dau_thang_nay, $now])
            ->orderBy('created_at', 'ASC')
            ->groupByRaw('DATE(created_at)')
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->get();
        }
        // else{
        //     $get=JobPost::whereBetween('allow_date', [$sub365days, $now])->orderBy('allow_date', 'ASC')->get();
        // }
        if($get){
            foreach($get as $value){
                // $total_post=JobPost::where('company_id', $company->id)->whereBetween('allow_date', $value->allowdate)->orderBy('allow_date', 'ASC')->get();
                $chart_data[] = array(
                    'period' =>$value->date,
                    'total_cv'=>$value->count,
                );
            }
        }
        else{
            $chart_data[] = array(
                'period' =>0,
                    'total_cv'=>0,
            );
        }
        echo $data = json_encode($chart_data);
    }
}
