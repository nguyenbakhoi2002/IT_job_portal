<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CandidateRequest;
use Illuminate\Support\Str;
use Hash;
use DB;
use App\Models\Candidate;
use App\Models\SavedCandidates;
use App\Models\SavedCompanies;
use App\Models\SavedJobs;
use App\Models\JobPostActivity;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Project;
use App\Models\SeekerLanguage;
use App\Models\SeekerSkill;


class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $company = Candidate::paginate(10);
        if($key = request()->key){
            $company = Candidate::where('email','like','%' . $key . '%')->paginate(10);
        }
        return view('admin.candidate.index', ['companies' => $company, 'title'=>"Danh sách ứng viên"]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.candidate.add', ['title'=>"Thêm ứng viên"]);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CandidateRequest $request)
    {
        try {
            $file_name_logo="";
            //lấy tên  bỏ dấu và cách để cho vào tên ảnh;
            $name_user=Str::slug($request->name);
            if($request->has('user_image_clone')){
                $file = $request->user_image_clone;
                //lấy đuôi ảnh
                $ext = $file->extension();
                $file_name_logo = time()."-logo-".$name_user.".".$ext;
                //lưu file vào thư mục
                $file->move(public_path('uploads/images/candidate'), $file_name_logo);
            }   
            $request->merge(['user_image'=>$file_name_logo ]);
            $request->merge(['password'=>Hash::make($request->password)]);
            Candidate::create($request->all());
            return redirect()->route('admin.candidate.index')->with('success', 'thêm mới thành công');
        } catch (\Exception  $e) {
            return redirect()->back()->with('error', 'thêm mới thất bại'.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Candidate $candidate)
    {
        return view('admin.candidate.edit', ['title'=>'Cập nhật ứng viên', 'candidate' => $candidate]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CandidateRequest $request, Candidate $candidate)
    {
        // dd($request->all());
        try {
            $file_name_logo="";
            //lấy tên  bỏ dấu và cách để cho vào tên ảnh;
            $name_user=Str::slug($request->name);
            if($request->has('user_image_clone')){
                $file = $request->user_image_clone;
                //lấy đuôi ảnh
                $ext = $file->extension();
                $file_name_logo = time()."-logo-".$name_user.".".$ext;
                //lưu file vào thư mục
                $file->move(public_path('uploads/images/candidate'), $file_name_logo);
            }
            else{
                $file_name_logo =$request->user_image_hd;
            }    
            // $request->user_image=$file_name_logo;
            // $request->test=$file_name_logo;

            $request->merge(['user_image'=>$file_name_logo ]);
            // dd($request->user_image);  
            // dd($request->all());

            if($request->filled('new_password')){
                $request->merge(['password'=>Hash::make($request->new_password)]);
                // dd('a');
            }
            // dd($request->all());
            $candidate->update($request->all());

            return redirect()->route('admin.candidate.index')->with('success', 'sửa thành công');
        } catch (\Exception  $e) {
            return redirect()->back()->with('error', 'sửa thất bại'.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidate $candidate)
    {
        try {
            $candidate->delete();
            return redirect()->route('admin.candidate.index')->with('success', 'Xóa thành công');
        } catch (\Exception  $e) {
            return redirect()->back()->with('error', 'Xóa thất bại'.$e->getMessage());
        }
    }
    public function trash(){
        $candidate = Candidate::onlyTrashed()->paginate(10);
        if($key = request()->key){
            $company = Candidate::onlyTrashed()->where('name','like','%' . $key . '%')->paginate(10);
        }
        return view('admin.candidate.trash',['candidates' => $candidate, 'title'=>'thùng rác']);
    }
    public function restore(string $id){
        

        Candidate::withTrashed()->where('id', $id)->restore();
        return redirect()->route('admin.candidate.index')->with('success', 'Khôi phục thành công');
    }
    public function force(string $id){
        try{
            DB::beginTransaction();
            $candidate = Candidate::withTrashed()->find($id);
            $seeker_profile = $candidate->seekerProfile()->get();
            $seeker_profile_ids = $candidate->seekerProfile()->pluck('id')->toArray();


            //xóa những bản ghi có khóa ngoại
            $saved_company = SavedCompanies::where('candidate_id', $id)->delete();
            $saved_candidates = SavedCandidates::where('candidate_id', $id)->delete();
            $saved_job = SavedJobs::where('candidate_id', $id)->delete();
            $seeker_skill = SeekerSkill::whereIn('seeker_profile_id', $seeker_profile_ids)->delete();
            $seeker_language = SeekerLanguage::whereIn('seeker_profile_id', $seeker_profile_ids)->delete();
            $project = Project::whereIn('seeker_profile_id', $seeker_profile_ids)->delete();
            $experience = Experience::whereIn('seeker_profile_id', $seeker_profile_ids)->delete();
            $education = Education::whereIn('seeker_profile_id', $seeker_profile_ids)->delete();
            $jobpost_activityv = JobPostActivity::whereIn('seeker_profile_id', $seeker_profile_ids)->delete();
            $candidate->seekerProfile()->forceDelete();
            //
            $candidate->forceDelete();
            DB::commit();
            return response()->json(['success'=>'Xóa thành công!']);
        }catch(Exception $e){
            DB::rollback();
            return response()->json(['error'=>'Xóa thất bại!'.$e]);

        }
        
        
        // return redirect()->route('admin.company.trash')->with('success', 'Xóa thành công');

    }

    //ajax messages
    public function status(Request $request, string $id){
        $val = $request->status;
        Candidate::where('id', $id)->update(['status' => $val]);
        return response()->json(['success'=>'Cập nhật trạng thái thành công!']);
    }
}
