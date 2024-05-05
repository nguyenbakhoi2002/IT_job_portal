<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        return view('company.dashboard', 
        ['title' => $title, 'list_job' => $list_job, 'count_applied' => $count_applied, 'activeRoute'=>'dashboard']);
    }
}
