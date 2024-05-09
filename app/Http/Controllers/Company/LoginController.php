<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\Company\RegisterRequest;
use Illuminate\Support\Facades\Session;
use Hash;

class LoginController extends Controller
{
    public function login(){
        return view('company.login');
    }
    public function postLogin(LoginRequest $request){
        $email = $request->input('email');
        $password = $request->input('password');
        if (auth('company')->attempt(['email'=>$email, 'password'=>$password])){
            $data = auth('company')->user();
            auth('company')->login($data);
            return redirect()->route('company.dashboard');
        } else {
            Session::flash('error', 'Email hoặc mật khẩu không đúng');
            return redirect()->back()->withInput();
        }
    }
    public function logout() {
        auth('company')->logout();
        return  redirect()->route('company.login');
    }
    public function register(){
        return view('company.register');
    }
    public function postRegister(RegisterRequest $request){
        $request->merge(['password'=>Hash::make($request->password)]);
        try {
            Company::create($request->all());
        } catch (\Throwable $th) {
            dd($th);
        }
        return redirect()->route('company.login')->with('success', 'Tạo tài khoản mới thành công');
    }
}
