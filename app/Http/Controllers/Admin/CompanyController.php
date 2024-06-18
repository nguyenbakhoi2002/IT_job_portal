<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CompanyRequest;
use App\Http\Requests\Admin\UpdateCompanyRequest;
use App\Models\Company;
use App\Models\SavedCompanies;
use App\Models\JobPostActivity;
use App\Models\SavedJobs;
use App\Models\JobPostLanguage;
use App\Models\JobPostSkill;
use App\Models\SavedCandidates;
use Illuminate\Support\Str;
use Hash;
use DB;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        // $this->middleware(['checkAdminType'])->only(['force']);
    }
    public function index()
    {
        $company = Company::paginate(10);
        if($key = request()->key){
            $company = Company::where('company_name','like','%' . $key . '%')->paginate(10);
        }
        return view('admin.company.index', ['companies' => $company, 'title'=>"Danh sách công ty"]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.company.add', ['title'=>"Thêm công ty"]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {
        try {
            $file_name_logo="";
            $file_name_image_paper="";
            //lấy tên  bỏ dấu và cách để cho vào tên ảnh;
            $name_company=Str::slug($request->company_name);
            if($request->has('hinhanh_upload_logo')){
                $file = $request->hinhanh_upload_logo;
                //lấy đuôi ảnh
                $ext = $file->extension();
                $file_name_logo = time()."-logo-".$name_company.".".$ext;
                //lưu file vào thư mục
                $file->move(public_path('uploads/images/company'), $file_name_logo);
            }   
            $request->merge(['logo'=>$file_name_logo ]);
            if($request->has('hinhanh_upload_image_paper')){
                $file = $request->hinhanh_upload_image_paper;
                $ext = $file->extension();
                $file_name_image_paper = time()."-paper-".$name_company.".".$ext;
                $file->move(public_path('uploads/images/image_paper'), $file_name_image_paper);
            }   
            $request->merge(['image_paper'=>$file_name_image_paper ]);
            $request->merge(['password'=>Hash::make($request->password)]);
            Company::create($request->all());
            return redirect()->route('admin.company.index')->with('success', 'thêm mới thành công');
        } catch (\Exception  $e) {
            return redirect()->back()->with('error', 'thêm mới thất bại'.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('admin.company.edit', ['title'=>'Cập nhật công ty', 'company' => $company]);
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, Company $company)
    {
       
        try {
            $file_name_logo="";
            $file_name_image_paper="";
            //lấy tên sản phẩm bỏ dấu và cách để cho vào tên ảnh;
            $name_company=Str::slug($request->company_name);
            if($request->has('hinhanh_upload_logo')){
                $file = $request->hinhanh_upload_logo;
                //lấy đuôi ảnh
                $ext = $file->extension();
                $file_name_logo = time()."-logo-".$name_company.".".$ext;
                //lưu file vào thư mục
                $file->move(public_path('uploads/images/company'), $file_name_logo);
            }else{
                $file_name_logo =$request->hinhanh_upload_logo_hd;
            }   
            $request->merge(['logo'=>$file_name_logo ]);
            if($request->has('hinhanh_upload_image_paper')){
                $file = $request->hinhanh_upload_image_paper;
                $ext = $file->extension();
                $file_name_image_paper = time()."-paper-".$name_company.".".$ext;
                $file->move(public_path('uploads/images/image_paper'), $file_name_image_paper);
            }else{
                $file_name_image_paper =$request->hinhanh_upload_image_paper_hd;
            }   

            $request->merge(['image_paper'=>$file_name_image_paper ]);
            // $request->merge(['password'=>Hash::make($request->password)]);
            $company->update($request->all());
            
            
            return redirect()->route('admin.company.index')->with('success', 'sửa thành công');
        } catch (\Exception  $e) {
            return redirect()->back()->with('error', 'sửa thất bại'.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        try {
            $company->delete();
            return redirect()->route('admin.company.index')->with('success', 'Xóa thành công');
        } catch (\Exception  $e) {
            return redirect()->back()->with('error', 'Xóa thất bại'.$e->getMessage());
        }
    }

    //thùng rác
    public function trash(){
        $company = Company::onlyTrashed()->paginate(10);
        if($key = request()->key){
            $company = Company::onlyTrashed()->where('name','like','%' . $key . '%')->paginate(10);
        }
        return view('admin.company.trash',['companies' => $company, 'title'=>'thùng rác']);
    }
    public function restore(string $id){
        Company::withTrashed()->where('id', $id)->restore();
        return redirect()->route('admin.company.index')->with('success', 'Khôi phục thành công');
    }
    public function force(string $id){
        if(auth('admin')->user()->type==0)
        return response()->json(['error'=>'Bạn không có quyền xóa dữ liệu']);
        DB::beginTransaction();
        try{
            $company = Company::withTrashed()->find($id);
            $posts = $company->jobPost()->get();
            $post_ids = $company->jobPost()->pluck('id')->toArray();
            // dd($post_ids);
            // dd($posts);
            //xóa saved company,
            $saved_company = SavedCompanies::where('company_id', $id)->delete();
            // saved candidate
            $saved_candidates = SavedCandidates::where('company_id', $id)->delete();
            //jobpost skill
            $jobpost_skill = JobPostSkill::whereIn('job_post_id', $post_ids)->delete();
            //jobpost_language
            $jobpost_language  = JobPostLanguage::where('job_post_id', $post_ids)->delete();
            //saved job
            $saved_job = SavedJobs::where('job_post_id', $post_ids)->delete();
            //jobpost activity,
            $jobpost_activityv = JobPostActivity::where('job_post_id', $post_ids)->delete();
            //job post
            $company->jobPost()->forceDelete();
            $company->forceDelete();
            DB::commit();
            return response()->json(['success'=>'Xóa thành công!']);
        }catch(Exception $e){
            DB::rollback();
            return response()->json(['error'=>'Xóa thất bại! lỗi'.$e]);
        }
        
        
        

    }

    //ajax messages
    public function status(Request $request, string $id){
        $val = $request->status;
        Company::where('id', $id)->update(['status' => $val]);
        return response()->json(['success'=>'Cập nhật trạng thái thành công!']);
    }
    public function companyWaiting(){
        $company = Company::where('status', 0)->paginate(10);
        if($key = request()->key){
            $company = Company::where('status', 0)->where('company_name','like','%' . $key . '%')->paginate(10);
        }
        return view('admin.company.companyWaiting',['companies' => $company, 'title'=>"Danh sách công ty bị chặn"]);
    }
    public function companyAccept(Request $request, string $id){
        Company::where('id', $id)->update([
            'status' => 1,
        ]);
        return response()->json(['success'=>'Bỏ chặn thành công']);
    }
}
