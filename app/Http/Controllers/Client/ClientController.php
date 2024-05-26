<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\Client\RegisterRequest;
use Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\FindPwRequest;


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
    //quên mật khẩu
    public function refresh(){
        return view('client.refresh-password');
    }
    public function refreshPass(ForgotPasswordRequest $request){
        $candidate = Candidate::where('email', $request->email)->first();
        $token = strtoupper(Str::random(10));

        $candidate->update([
            'token' => $token,
        ]); 
        Mail::send('email.forget-pass', compact('candidate'), function ($email) use ($candidate) {
            $email->subject('BaKhoi - Lấy Lại Mật Khẩu');
            $email->to($candidate->email, $candidate->name);
        });
        return redirect()->route('login')->with('success', 'Vui Lòng Kiểm Tra Mail Để Thực Hiện Thay Đổi Mật Khẩu');
    }
    public function getPass(Candidate $candidate)
    {

        return view('email.get-pass', ['candidate' => $candidate]);
    }
    public function postPass(FindPwRequest $request)
    {
        $candidate = Candidate::where('token', $request->token)->where('email', $request->email)->first();
        
        if ($candidate) {
                $candidate->update([
                    'token' => null,
                    'password' => bcrypt($request->password)

                ]);
                return redirect()->route('login')->with('success', 'Đổi mật khẩu thành công');
            
        } else {
            return redirect()->back()->with('error', 'Mã xác nhận không chính xác');
        }
    }
}
