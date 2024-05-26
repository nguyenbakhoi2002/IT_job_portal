<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use App\Http\Requests\Admin\AdminRequest;
use App\Http\Requests\Client\ChangePwRequest;

use Hash;
use Session;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(){
        return view('admin.login');
    }
    public function postLogin(LoginRequest $request){
        $email = $request->input('email');
        $password = $request->input('password');
        if (auth('admin')->attempt(['email'=>$email, 'password'=>$password])){
            $data = auth('admin')->user();
            auth('admin')->login($data);
            return redirect()->route('admin.dashboard');
        } else {
            Session::flash('error', 'Email hoặc mật khẩu không đúng');
            return redirect()->back()->withInput();
        }
    }
    public function logout() {
        auth('admin')->logout();
        return  redirect()->route('admin.login');
    }
    public function index()
    {
        $admins = Admin::paginate(10);
        if($key = request()->key){
            $admins = Admin::where('name','like','%' . $key . '%')->paginate(10);
        }
        return view('admin.admin.index', ['skills' => $admins, 'title'=>"Danh sách nhân viên và quản trị"]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admin.add', ['title'=>"Thêm nhân viên"]);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
        try {
            $file_name_logo="";
            //lấy tên  bỏ dấu và cách để cho vào tên ảnh;
            $name_company=Str::slug($request->name);
            if($request->has('hinhanh_upload_logo')){
                $file = $request->hinhanh_upload_logo;
                //lấy đuôi ảnh
                $ext = $file->extension();
                $file_name_logo = time()."-logo-admin-".$name_company.".".$ext;
                //lưu file vào thư mục
                $file->move(public_path('uploads/images/admin'), $file_name_logo);
            }   
            $request->merge(['image'=>$file_name_logo ]);
            $request->merge(['password'=>Hash::make($request->password)]);
            // dd($request->all());
            Admin::create($request->all());
            // dd('thêm được');

            return redirect()->route('admin.admin.index')->with('success', 'thêm mới thành công');
        } catch (\Exception  $e) {
            // dd('lỗi');

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
    public function edit(Admin $admin)
    {
        return view('admin.admin.edit', ['title'=>'Cập nhật nhân viên', 'admin' => $admin]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $request, Admin $admin)
    {
        // dd($request->all());
        try {
            $file_name_logo="";
            //lấy tên sản phẩm bỏ dấu và cách để cho vào tên ảnh;
            $name_company=Str::slug($request->name);
            if($request->has('hinhanh_upload_logo')){
                $file = $request->hinhanh_upload_logo;
                //lấy đuôi ảnh
                $ext = $file->extension();
                $file_name_logo = time()."-logo-".$name_company.".".$ext;
                //lưu file vào thư mục
                $file->move(public_path('uploads/images/admin'), $file_name_logo);
            }else{
                $file_name_logo =$request->hinhanh_upload_logo_hd;
            }   
            $request->merge(['image'=>$file_name_logo ]);
            if($request->password_new){
                $request->merge(['password'=>Hash::make($request->password_new)]);
            }
            $admin->update($request->all());
            Session::flash('success', 'Thêm thành công!');
            return redirect()->route('admin.admin.index')->with('success', 'sửa thành công');
        } catch (\Exception  $e) {
            return redirect()->back()->with('error', 'sửa thất bại'.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function detail(){
        // $id = auth('candidate')->user()->id;
        $detail =  auth('admin')->user();
        return view('admin.admin.info', ['detail'=>$detail]);
    }
    public function updateDetail(AdminRequest $request){
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
                $file->move(public_path('uploads/images/admin'), $file_name_logo);
            }
            else{
                $file_name_logo =$request->user_image_hd;
            }    
            // dd($request->all());
            $request->merge(['image'=>$file_name_logo ]);

            $candidate = auth('admin')->user();
            $candidate->update($request->all());
            return redirect()->back()->with('success', 'sửa thành công');
        } catch (\Exception  $e) {
            return redirect()->back()->with('error', 'sửa thất bại'.$e->getMessage());
        }
    }
    public function changePassword()
    {
        $detail = auth('admin')->user();
        return view('admin.admin.change-password', ['detail' =>$detail]);
    }
    public function updatePassword(ChangePwRequest $request)
    {
        $client = auth('admin')->user();

        if (Hash::check($request->password_old, $client->password)) {
            $request->merge(['password'=>Hash::make($request->password)]);
            $client->update(['password'=>$request->password]);
            Session::flash('success', 'Đổi mật khẩu thành công! Vui lòng đăng nhập lại');
            auth('admin')->logout();
            return  redirect()->route('admin.login');
        }else {
            Session::flash('error', 'Mật khẩu cũ không đúng!');
            return Redirect()->back();
        }
    }
}
