<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use App\Http\Requests\Admin\AdminRequest;


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
        Admin::create($request->all());
        return redirect()->route('admin.admin.index')->with('success', 'thêm mới thành công');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
