<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
use App\Models\Company;
use App\Models\Major;
use App\Models\Skill;
use App\Models\Candidate;
use App\Models\Degree;
use App\Models\Language;
use App\Models\SeekerProfile;
use App\Models\JobPostActivity;
use App\Models\TimeExperience;
use DB;

class ProfileApplyController extends Controller
{
    public function profileAll(){
        //lấy ra các list của công ty
        $company = auth('company')->user();
        $list_job = $company->jobPost;
        // $list_profile = new Collection();
        
        // foreach($list_job as $item){
        //     $seekerProfiles = $item->seekerProfile()->get();
        //     $list_profile = $list_profile->merge($seekerProfiles);
        // }
        // chuyển về dạng này để sử dụng paginate
        // $list_profile = $list_profile->first()->newQuery()->paginate(10);
        //mảng
        // $list_profile = [];
        // foreach($list_job as $item){
        //     $seekerProfiles = $item->seekerProfile()->get();
        //     $list_profile = array_merge($list_profile, $seekerProfiles->toArray());
        // }
        //
        // $list_profile = JobPostActivity::with('seeker')
        //                 ->where('company_id',$company->id)
        //                 ->orderBy('id', 'DESC')
        //                 ->groupby('seeker_profile_id')
        //                 ->select(['seeker_profile_id'])
        //                 ->paginate(10);
        $list_profile = $company->seekerProfile()->paginate(10);
        // dd($list_profile);
        $title = "Danh sách ứng tuyển";
        return view('company.profile.profileAll', 
        ['title' => $title, 'list_seekerProfile'=>$list_profile, 'activeRoute'=>'manage-cv']);
    }
    public function profileFilter(){
        $company = auth('company')->user();
        $major = Major::where('status', 1)->get();
        $degree = Degree::where('status', 1)->get();
        $time_exp = TimeExperience::where('status', 1)->get();
        $skill = Skill::all();
        $language = Language::where('status', 1)->get();
        //tạo ra một đối tượng rỗng
        $seekerProfile = Candidate::where('status', 30)->paginate(6);

        // lấy ra những profile đã nộp vào công ty
        $data = DB::table('job_post_activity')->where('company_id', $company->id)->select('seeker_profile_id')
        ->groupby('seeker_profile_id')->pluck('seeker_profile_id')->toArray();
        // loại bỏ những profile đó ra
        $query = SeekerProfile::whereNotIn('id',$data)->where('is_clone', 0)->with('candidate');
        if(request()->search_address || request()->major || request()->gender || request()->skill || 
        request()->experience || request()->type_degree || request()->language || request()->language_level){
            $gender_search = request()->gender;
            $skill_search = request()->skill;
            $major_search = request()->major;
            $type_degree_search = request()->type_degree;
            $language_search = request()->language;
            $language_level_search = request()->language_level;
            $search_address = request()->search_address;
            $selectYearKn = request()->experience;
            if(!empty($search_address)) {
                $query = $query->where('address', 'like', "%{$search_address}%");
            }
            if(!empty($gender_search)){
                $query = $query->where('gender', $gender_search);
            }
            if(isset($selectYearKn)) {
                $query = $query->where('total_experience','>=', $selectYearKn);
            }
            if(!empty($skill_search)) {
                $query = $query->whereHas('seekerSkill', function($q) use ($skill_search) {
                    $q->where('skill_id', $skill_search);
                });
            }
            
            if(!empty($major_search)) {
                $query = $query->whereHas('educations', function($q) use ($major_search) {
                    $q->where('major_id', $major_search);
                });
            }
            if(!empty($type_degree_search)) {
                $query = $query->whereHas('educations', function($q) use ($type_degree_search) {
                    $q->where('degree_id', $type_degree_search);
                });
            }
            if(!empty($language_search)&&!empty($language_level_search)) {
                $query = $query->whereHas('seekerLanguage', function($q) use ($language_search, $language_level_search) {
                    $q->where('language_id', $language_search)
                      ->where('level','>=', $language_level_search);
                });
            }
            $data_id=$query->pluck('id')->toArray();
            $seekerProfile=SeekerProfile::whereIn('id', $data_id)->paginate(12);
            // dd($seekerProfile);

        }

        return view('company.profile.search-seeker', ['company'=>$company, 'major' => $major, 'title'=>'Tìm kiếm ứng viên',
        'skill' => $skill, 'time_exp' => $time_exp, 'degree' => $degree,'language'=>$language, 'seekerProfile'=>$seekerProfile]);
    }
    public function statusAll(Request $request, string $id){
        $val = $request->status;
        JobPostActivity::where('id', $id)->update(['seen' => $val]);
        return response()->json(['success'=>'Cập nhật trạng thái thành công!']);
    }
    public function statusOwn(Request $request, string $id){
        $val = $request->status;
        JobPostActivity::where('id', $id)->update(['seen' => $val]);
        return response()->json(['success'=>'Cập nhật trạng thái thành công!']);
    }
}
