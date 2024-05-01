<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SavedJobController extends Controller
{
    //thực hiện lưu
    public function saveJob(string $id){
        // dd(auth('candidate')->user()->saved_jobs->pluck('id')->toArray());
        // dd($id);
        //$id là id của bài tuyển được click
        //lấy ra id của tài khoản đang đnăg nhập
        $client = auth('candidate')->user();
        $result=$client->saved_jobs()->attach($id, ['created_at' => now(), 'updated_at' => now()]);
        return redirect()->back()->with('success', 'Lưu công việc thành công');
    }
    //thực hiện hủy lưu
    public function cancelSaveJob(string $id){
        // dd($id);
        //$id là id của bài tuyển được click
        //lấy ra id của tài khoản đang đnăg nhập
        $client = auth('candidate')->user();
        $result=$client->saved_jobs()->detach($id);
        return redirect()->back()->with('success', 'Hủy lưu công việc thành công');
    }
    //danh sách những bài đã lưu
    public function jobSaved(){
        $client = auth('candidate')->user();
        //lấy ra những ban ghi trong bảng trung gian saved_jobs
        $saved_jobs = $client->saved_jobs;
        //lấy ra những profile của candidate
        $client_profile = $client->seekerProfile()->pluck('id')->toArray();
        
        return view('client.candidate.job-saved', ['saved_jobs'=>$saved_jobs, 'client_profile'=>$client_profile]);
    }
}
