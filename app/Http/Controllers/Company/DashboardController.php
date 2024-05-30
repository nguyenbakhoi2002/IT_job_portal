<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use DB;

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
        $range = Carbon::now()->subDays(365);

        // Truy vấn dữ liệu từ bảng orders và nhóm theo tháng
        // $stats = DB::table('job_posts')
        //     ->where('company_id',  $company->id)
        //     ->where('status',  1)
        //     ->where('created_at', '>=', $range)
        //     ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
        //     ->orderBy(DB::raw('YEAR(created_at)'), 'ASC')
        //     ->orderBy(DB::raw('MONTH(created_at)'), 'ASC')
        //     ->get([
        //         DB::raw('YEAR(created_at) as year'),
        //         DB::raw('MONTH(created_at) as month'),
        //         DB::raw('COUNT(*) as value')
        //     ])
        //     ->toJSON();

// In ra hoặc trả về kết quả dưới dạng JSON
// return response()->json($stats);




        return view('company.dashboard', 
        ['title' => $title, 'list_job' => $list_job, 'count_applied' => $count_applied, 'activeRoute'=>'dashboard']);
    }
    public function chart(Request $request){
        $company = auth('company')->user();
        // Get the number of days to show data for, with a default of 7
        $days = $request->input('days',365);
    
        $range = Carbon::now()->subDays($days);
    
        $stats = DB::table('job_posts')
                ->where('company_id',  $company->id)
                ->where('status',  1)
                ->where('created_at', '>=', $range)
                ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
                ->orderBy(DB::raw('YEAR(created_at)'), 'ASC')
                ->orderBy(DB::raw('MONTH(created_at)'), 'ASC')
                ->get([
                    DB::raw('YEAR(created_at) as date'),
                    // DB::raw('MONTH(created_at) as month'),
                    DB::raw('COUNT(*) as value')
                ]);
        return $stats;
    }
}
