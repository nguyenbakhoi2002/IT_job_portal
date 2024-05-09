<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\LoginRequest;

use Hash;
use Session;

class AdminController extends Controller
{
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
}
