<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\Candidate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;



class LoginGoogleController extends Controller
{
    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback(){
        try{
            $candidate = Socialite::driver('google')->user();
            // dd($candidate);

            $findCandidate = Candidate::where('google_id', $candidate->id)->first();
            if($findCandidate){
                // dd('if');
                auth('candidate')->login($findCandidate);
                Session::flash('success', 'Chào mừng bạn đăng nhập vào hệ thống');
                return redirect()->intended('/');
            }
            else{
                // dd('else');
                $pw = strtoupper(Str::random(10));
                $newCandidate=Candidate::create([
                    'name'=>$candidate->name,
                    'email'=>$candidate->email,
                    'google_id'=>$candidate->id,
                    'password'=>encrypt($pw)
                ]);
                auth('candidate')->login($newCandidate);
                Session::flash('success', 'Chào mừng bạn đăng nhập vào hệ thống');
                return redirect()->intended('/');
            }
        }catch( Exception $e){
            dd($e->getMessage());
        }
    }
}
