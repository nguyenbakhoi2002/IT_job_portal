<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
use App\Models\Company;
use App\Models\JobPostActivity;


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
