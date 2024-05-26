<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\UpdateCompanyRequest;
use App\Http\Requests\Admin\paperUpdateCompanyRequest;
use Illuminate\Support\Str;
use App\Http\Requests\Client\ChangePwRequest;
use App\Http\Requests\ForgotPasswordCompanyRequest;
use App\Models\Company;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\FindPwRequest;
use Session;
use Hash;

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
    public function changePassword()
    {
        $detail = auth('company')->user();
        return view('company.info.change-password', ['detail' =>$detail, 'title'=>'Đổi mật khẩu công ty']);
    }
    public function updatePassword(ChangePwRequest $request)
    {
        $company = auth('company')->user();

        if (Hash::check($request->password_old, $company->password)) {
            $request->merge(['password'=>Hash::make($request->password)]);
            $company->update(['password'=>$request->password]);
            Session::flash('success', 'Đổi mật khẩu thành công! Vui lòng đăng nhập lại');
            auth('company')->logout();
            return  redirect()->route('company.login');
        }else {
            Session::flash('error', 'Mật khẩu cũ không đúng!');
            return Redirect()->back();
        }
    }
    //quên mật khẩu
    public function refresh(){
        return view('client.refresh-password');
    }
    public function refreshPass(ForgotPasswordCompanyRequest $request){
        $candidate = Company::where('email', $request->email)->first();
        $token = strtoupper(Str::random(10));

        $candidate->update([
            'token' => $token,
        ]); 
        Mail::send('email.forget-pass-company', compact('candidate'), function ($email) use ($candidate) {
            $email->subject('BaKhoi - Lấy Lại Mật Khẩu Nhà Tuyển Dụng');
            $email->to($candidate->email);
        });
        return redirect()->route('company.login')->with('success', 'Vui Lòng Kiểm Tra Mail Để Thực Hiện Thay Đổi Mật Khẩu');
    }
    public function getPass(Company $company)
    {

        return view('email.get-pass', ['candidate' => $company]);
    }
    public function postPass(FindPwRequest $request)
    {
        $candidate = Company::where('token', $request->token)->where('email', $request->email)->first();
        if ($candidate) {
                $candidate->update([
                    'token' => null,
                    'password' => bcrypt($request->password)

                ]);
                return redirect()->route('company.login')->with('success', 'Đổi mật khẩu thành công');
            
        } else {
            return redirect()->back()->with('error', 'Mã xác nhận không chính xác');
        }
    }
    
}
