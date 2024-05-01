<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Candidate;
use App\Http\Requests\Client\CandidateRequest;
use App\Http\Requests\Client\ChangePwRequest;
use Illuminate\Support\Str;
use Hash;
use Session;



class CandidateController extends Controller
{
    public function detail(){
        // $id = auth('candidate')->user()->id;
        $detail =  auth('candidate')->user();
        return view('client.candidate.detail', ['detail'=>$detail]);
    }
    public function updateDetail(CandidateRequest $request){
        try {
            $file_name_logo="";
            //lấy tên  bỏ dấu và cách để cho vào tên ảnh;
            $name_user=Str::slug($request->name);
            if($request->has('image')){
                $file = $request->image;
                //lấy đuôi ảnh
                $ext = $file->extension();
                $file_name_logo = time()."-logo-".$name_user.".".$ext;
                //lưu file vào thư mục
                $file->move(public_path('uploads/images/candidate'), $file_name_logo);
            }
            else{
                $file_name_logo =$request->image_hd;
            }    
            
            $request->merge(['user_image'=>$file_name_logo ]);

            $candidate = auth('candidate')->user();
            $candidate->update($request->all());
            return redirect()->back()->with('success', 'sửa thành công');
        } catch (\Exception  $e) {
            return redirect()->back()->with('error', 'sửa thất bại'.$e->getMessage());
        }
    }
    public function changePassword()
    {
        $detail = auth('candidate')->user();
        return view('client.candidate.change-password', ['detail' =>$detail]);
    }
    public function updatePassword(ChangePwRequest $request)
    {
        $client = auth('candidate')->user();

        if (Hash::check($request->password_old, $client->password)) {
            $request->merge(['password'=>Hash::make($request->password)]);
            $client->update(['password'=>$request->password]);
            Session::flash('success', 'Đổi mật khẩu thành công! Vui lòng đăng nhập lại');
            auth('candidate')->logout();
            return  redirect()->route('login');
        }else {
            Session::flash('error', 'Mật khẩu cũ không đúng!');
            return Redirect()->back();
        }
    }
}
