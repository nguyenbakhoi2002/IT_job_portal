<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use Carbon\Carbon;
class CompanyController extends Controller
{
    public function index(){
        $data = Company::where('status', 1)->paginate(10);
        $key_name = request()->key_name;
        $key_address = request()->key_address;
        if(isset($key_name)){
            $data = Company::where('status', 1)->where('company_name', 'like', '%' . $key_name . '%')->paginate(10);
        }
        return view('client/company/company-list', ['data' => $data]);
    }
    public function detail(Company $company){
        //lấy json
        $jsonFilePath = storage_path('app\json\provinces.json');
        //đọc nội dung của tập tin json
        $jsonContent = file_get_contents($jsonFilePath);
        //chuyển đổi json thành mảng
        $dataProvinces = json_decode($jsonContent, true);

        $company_jobs = $company->jobPost()->paginate(6);
        if($key = request()->key){
            $company_jobs = $company->jobPost()->where('title','like','%' . $key . '%')->paginate(10);
        }
        // lấy ra số người đăng ký
        $nguoi_luu_congty = $company->nguoi_luu_congty()->count();
        // dd($nguoi_luu_congty);
        $current_date = Carbon::now();
        return view('client/company/company-detail', 
        ['company_detail' => $company, 'company_jobs' => $company_jobs, 'current_date' => $current_date, 'dataProvinces' => $dataProvinces,
        'nguoi_luu_congty'=>$nguoi_luu_congty
        ]);
    }
}
