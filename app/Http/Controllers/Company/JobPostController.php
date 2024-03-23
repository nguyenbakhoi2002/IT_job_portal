<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//model
use App\Models\JobPost;
use App\Models\Major;
use App\Models\Skill;
use App\Models\TimeExperience;
use App\Models\Degree;

//request
use App\Http\Requests\Company\JobPostRequest;
//
use Illuminate\Support\Facades\Session;



class JobPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Bài đăng";
        $company_id = auth('company')->user()->id;
        $list_jobs = JobPost::where('company_id', $company_id)->paginate(10);

        //loc.start
        
        // dd($list_jobs->find(3)->seekerProfileRequest(0, 0)->get());
        //dd($list_jobs->find(1)->degree);
        //dd($list_jobs->find(3)->experience);

        //lấy ra mảng skill_id để so sánh
        //dd($list_jobs->find(1)->seekerProfile()->find(1)->skills);
        // dd($list_jobs->find(1)->seekerProfile()->find(1)->skills->pluck('id')->toArray());

        //loc end
        
        if($key = request()->key){
            $list_jobs = JobPost::where('title','like','%' . $key . '%')->paginate(10);
        }
        return view('company.post.index', ['title'=>$title, 'list_jobs'=>$list_jobs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //lấy json
        $jsonFilePath = storage_path('app\json\provinces.json');
        //đọc nội dung của tập tin json
        $jsonContent = file_get_contents($jsonFilePath);
        //chuyển đổi json thành mảng
        $dataProvinces = json_decode($jsonContent, true);

        // dd($dataProvinces[0]['Ten']);



        //
        $title = "Thêm bài tuyển";
        $majors = Major::all();
        $skills = Skill::all();
        $time_exp = TimeExperience::where('status', 1)->orderBy('level')->get();
        $degrees = Degree::where('status', 1)->orderBy('level')->get();
        return view('company.post.add', 
        ['title'=>$title, 'majors'=>$majors, 'skills'=>$skills, 'time_exp'=>$time_exp, 'degrees'=>$degrees, 'dataProvinces'=>$dataProvinces]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JobPostRequest $request)
    {
        //dd($request->skill);
        try{
            $data = $request->all();
            //lấy ra id company
            $data['company_id'] = auth('company')->user()->id;
            $data['status'] = 0;
            // dd($request->skill);
            //thêm dữ liệu vào bảng job-post
            $jp = JobPost::create($data);
            //lấy ra dữ liệu skill
            $skills = $request->skill;
            //thêm dữ liệu vào bảng trung gian
            $jp->skills()->attach($skills);
            Session::flash('success', 'Thêm thành công!');
            return Redirect()->route('company.post.index');

        }
        catch(Exception $e){
            Session::flash('error', 'Lỗi thêm mới!');
            return Redirect()->route('company.post.create');
        }

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
    public function edit(JobPost $post)
    {
        //lấy file json
        $jsonFilePath = storage_path('app\json\provinces.json');
        //đọc nội dung của tập tin json
        $jsonContent = file_get_contents($jsonFilePath);
        //chuyển đổi json thành mảng
        $dataProvinces = json_decode($jsonContent, true);
        // dd($dataProvinces[0]['Ten']);
        //
        $title = "Sửa bài tuyển dụng";
        $majors = Major::all();
        $skills = Skill::all();
        $time_exp = TimeExperience::where('status', 1)->orderBy('level')->get();
        $degrees = Degree::where('status', 1)->orderBy('level')->get();
        //lấy ra thông tin tất cả các skill có trong bài đăng 
        //pluck chỉ lấy ra id, kết quả trả về collection
        $skillActive = $post->skills->pluck('id')->toArray();
        // dd($skillActive);
        return view('company.post.edit',
        ['post'=> $post, 'title'=>$title, 'majors'=>$majors, 'skills'=>$skills, 'time_exp'=>$time_exp,
         'degrees'=>$degrees, 'dataProvinces'=>$dataProvinces, 'skillActive'=>$skillActive]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobPostRequest $request, JobPost $post)
    {
        //dd($post);
        try {
            $skill=$request->skill;
            $post->update($request->all());
            //cập nhập dữ liệu trong bảng trung gian
            $post->skills()->sync($skill);
            Session::flash('success', 'Sửa bài đăng thành công!');
            return Redirect()->route('company.post.index');
        } catch (\Throwable $th) {
            Session::flash('error', 'Lỗi sửa!');
            return Redirect()->route('company.post.edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
