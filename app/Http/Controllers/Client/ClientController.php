<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\Client\RegisterRequest;
use Hash;

class ClientController extends Controller
{
    public function login(){
        return view('client.login');
    }
    public function postLogin(LoginRequest $request){
        $email = $request->input('email');
        $password = $request->input('password');
        if (auth('candidate')->attempt(['email'=>$email, 'password'=>$password])){
            $data = auth('candidate')->user();
            auth('candidate')->login($data);
            return redirect()->route('index');
        } else {
            Session::flash('error', 'Email hoặc mật khẩu không đúng');
            return redirect()->back()->withInput();
        }
    }
    public function register(){
        return view('client.register');
    }
    public function postRegister(RegisterRequest $request){
        $request->merge(['password'=>Hash::make($request->password)]);
        try {
            Candidate::create($request->all());
        } catch (\Throwable $th) {
            dd($th);
        }
        return redirect()->route('login')->with('success', 'Tạo tài khoản mới thành công');
    }
    public function logout() {
        auth('candidate')->logout();
        return  redirect()->route('login');
    }
}
