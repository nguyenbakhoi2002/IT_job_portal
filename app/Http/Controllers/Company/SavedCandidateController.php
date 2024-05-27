<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Candidate;

class SavedCandidateController extends Controller
{
    public function saveSeeker(string $id){
        // dd(auth('candidate')->user()->saved_jobs->pluck('id')->toArray());
        // dd($id);
        //$id là id của ứng viên được click
        //lấy ra id của tài khoản đang đnăg nhập
        $client = auth('company')->user();
        $result=$client->saved_candidates()->attach($id, ['created_at' => now(), 'updated_at' => now()]);
        return redirect()->back()->with('success', 'Lưu ứng viên thành công');
    }
    //thực hiện hủy lưu
    public function cancelSaveSeeker(string $id){
        // dd($id);
        //$id là id của bài tuyển được click
        //lấy ra id của tài khoản đang đnăg nhập
        $client = auth('company')->user();
        $result=$client->saved_candidates()->detach($id);
        return redirect()->back()->with('success', 'Hủy lưu ứng viên thành công');
    }
    //danh sách những bài đã lưu
    public function listSeekerSaved(){
        $client = auth('company')->user();
        //lấy ra những ban ghi trong bảng trung gian saved_jobs
        $saved_jobs = $client->saved_candidates()->paginate(20);
        if($key = request()->search){
            $saved_jobs = $client->saved_candidates()->where('name', 'like', '%'.$key.'%')->paginate(20);
            // $saved_jobs = $client->saved_candidates_search($key)->paginate(20);
        }
        //lấy ra những profile của candidate
        // $client_profile = $client->seekerProfile()->pluck('id')->toArray();
        
        return view('company.candidate.list-candidate-saved', ['list_seekerProfile'=>$saved_jobs, 'title'=>'Danh sách ứng viên đã lưu']);
    }
}
