<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CompanyRequest;
use App\Http\Requests\Admin\UpdateCompanyRequest;
use App\Models\Company;
use Illuminate\Support\Str;
use Hash;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
            $name_company=Str::slug($request->tendanhmuc);
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
        Company::withTrashed()->where('id', $id)->forceDelete();
        return response()->json(['success'=>'Xóa thành công!']);
        // return redirect()->route('admin.company.trash')->with('success', 'Xóa thành công');

    }

    //ajax messages
    public function status(Request $request, string $id){
        $val = $request->status;
        Company::where('id', $id)->update(['status' => $val]);
        return response()->json(['success'=>'Cập nhật trạng thái thành công!']);
    }
}
