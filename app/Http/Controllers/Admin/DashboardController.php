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


        //
        $edate = Carbon::now()->toDateString();
        $sdate = Carbon::now()->subDays(7)->toDateString();

        
        return view('admin.dashboard', ['candidate' => $candidate, 'company' => $company,
         'seekerProfile' => $seekerProfile, 'admin' => $admin, 'skill' => $skill, 'major' =>$major,
          'company_wait' => $company_wait, 'post_wait' => $post_wait , 'job_post'=>$job_post, 'sdate'=>$sdate, 'edate'=>$edate]);
    }
}
