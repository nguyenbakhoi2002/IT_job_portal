<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\UpdateCompanyRequest;
use App\Http\Requests\Admin\paperUpdateCompanyRequest;
use Illuminate\Support\Str;
use Session;
class CompanyController extends Controller
{
    public function info(){
        $company = auth('company')->user();
        return view('company.info.info', 
        ['activeRoute'=>'profile', 'data'=>$company, 'title'=>'Thông tin công ty']);
    }
    public function infoUpdate(UpdateCompanyRequest $request){
        $company = auth('company')->user();
        try {
            $file_name_logo="";
            //lấy tên bỏ dấu và cách để cho vào tên ảnh;
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
            $company->update($request->all());
            Session::flash('success', 'Thêm thành công!');
            return redirect()->back()->with('success', 'sửa thành công');
        } catch (\Exception  $e) {
            return redirect()->back()->with('error', 'sửa thất bại'.$e->getMessage());
        }

    }
    public function imagePaper(){
        $company = auth('company')->user();
        return view('company.info.image-paper', 
        ['activeRoute'=>'image-paper', 'data'=>$company, 'title'=>'Thông tin công ty']);
    }
    public function imagePaperUpdate(paperUpdateCompanyRequest $request){
        // dd('khôi');
        $company = auth('company')->user();

        try {
            $file_name_image_paper="";
            //lấy tên sản phẩm bỏ dấu và cách để cho vào tên ảnh;
            $name_company=Str::slug($request->company_name);
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
            Session::flash('success', 'Thêm thành công!');
            return redirect()->back()->with('success', 'sửa thành công');
        } catch (\Exception  $e) {
            return redirect()->back()->with('error', 'sửa thất bại'.$e->getMessage());
        }
    }
}
