<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SavedCompanyController extends Controller
{
    public function saveCompany(string $id){
        // dd(auth('candidate')->user()->saved_jobs->pluck('id')->toArray());
        // dd($id);
        //$id là id của bài tuyển được click
        //lấy ra id của tài khoản đang đnăg nhập
        $client = auth('candidate')->user();
        $result=$client->saved_companies()->attach($id);
        return redirect()->back()->with('success', 'Lưu công ty thành công');
    }
    public function cancelSaveCompany(string $id){
        // dd($id);
        //$id là id của bài tuyển được click
        //lấy ra id của tài khoản đang đnăg nhập
        $client = auth('candidate')->user();
        $result=$client->saved_companies()->detach($id);
        return redirect()->back()->with('success', 'Hủy lưu công ty thành công');
    }
    public function companySaved(){
        $client = auth('candidate')->user();
        //lấy ra những ban ghi trong bảng trung gian saved_jobs
        $saved_jobs = $client->saved_companies;
        //lấy ra những profile của candidate
        $client_profile = $client->seekerProfile()->pluck('id')->toArray();
        
        return view('client.candidate.company-saved', ['saved_jobs'=>$saved_jobs, 'client_profile'=>$client_profile]);
    }
}
