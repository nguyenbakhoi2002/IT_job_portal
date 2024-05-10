<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobPost;


class JobPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function jobPostWaiting(){
        $job = JobPost::where('status', 3)->paginate(10);
        if($key = request()->key){
            $job = JobPost::where('status', 3)->where('title','like','%' . $key . '%')->paginate(10);
        }
        return view('admin.post.job-post-waiting', ['companies' => $job, 'title'=>"Danh sách các công việc đợi duyệt"]);
    }
    public function jobAccept(Request $request, string $id){
        JobPost::where('id', $id)->update([
            'status' => 1,
            'admin_id' => auth('admin')->user()->id,
        ]);
        return response()->json(['success'=>'Duyệt bài đăng thành công']);
    }
    public function jobRefuse(Request $request, string $id){
        JobPost::where('id', $id)->update([
            'status' => 2,
            // 'admin_id' => auth('admin')->user()->id,
        ]);
        return response()->json(['success'=>'Xác nhận thành công']);
    }

    
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
