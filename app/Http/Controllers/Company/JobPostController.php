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
use App\Models\Language;
use App\Models\JobPostActivity;
use App\Models\JobPostLanguage;
use Illuminate\Support\Carbon;
use DB;
use App\Exports\ListProfileExport;
use Excel;

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
        $list_jobs = JobPost::where('company_id', $company_id)->where('status', 1)->paginate(10);

        //loc.start
        
        // dd($list_jobs->find(3)->seekerProfileRequest(0, 0)->get());
        //dd($list_jobs->find(1)->degree);
        //dd($list_jobs->find(3)->experience);

        //lấy ra mảng skill_id để so sánh
        //dd($list_jobs->find(1)->seekerProfile()->find(1)->skills);
        // dd($list_jobs->find(1)->seekerProfile()->find(1)->skills->pluck('id')->toArray());

        //loc end
        
        if($key = request()->key){
            $list_jobs = JobPost::where('company_id', $company_id)->where('title','like','%' . $key . '%')->paginate(10);
        }
        return view('company.post.index', ['title'=>$title, 'list_jobs'=>$list_jobs, 'activeRoute'=>'post']);
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
        $majors = Major::where('status', 1)->get();
        $skills = Skill::where('status', 1)->get();
        $languages = Language::where('status', 1)->get();

        $time_exp = TimeExperience::where('status', 1)->orderBy('level')->get();
        $degrees = Degree::where('status', 1)->orderBy('level')->get();
        return view('company.post.add', 
        ['title'=>$title, 'majors'=>$majors, 'skills'=>$skills, 'time_exp'=>$time_exp, 'degrees'=>$degrees,'languages'=>$languages,
         'dataProvinces'=>$dataProvinces, 'activeRoute'=>'post']);
    }

    /**
     * Store a newly created resource in storage.
     */
    // JobPostRequest
    public function store(Request $request)
    {
        // dd($request->all());
        //dd($request->skill);
        DB::beginTransaction();
        try{
            $data = $request->all();
            //lấy ra id company
            $data['company_id'] = auth('company')->user()->id;
            $data['status'] = 0;
            // dd($data);
            //thêm dữ liệu vào bảng job-post
            $jp = JobPost::create($data);
            //lấy ra dữ liệu skill
            $skills = $request->skill;
            //thêm dữ liệu vào bảng trung gian
            $jp->skills()->attach($skills);
            //thêm ngoại ngữ
            if($request->has('language_id')){
                $languageIds = $request->language_id;
                $language_levels = $request->language_level;
                //lấy ra id của bài đnăg vừa tạo
                $job_post_id = $jp->id;
                //chạy vòng for vì language_id nhận là mảng
                for ($i = 0; $i < count($languageIds); $i++) {
                    
                    $language_id = $languageIds[$i]; // Gán giá trị từ mảng language_id
                    $language_level = $language_levels[$i]; // Gán giá trị từ mảng level
                    JobPostLanguage::create([
                        'job_post_id'=>$job_post_id,
                        'language_id'=>$language_id,
                        'level'=>$language_level,
                    ]);
                }
            }
            DB::commit();
            Session::flash('success', 'Thêm thành công!');
            return Redirect()->route('company.postCreated');

        }
        catch(Exception $e){
            DB::rollBack();
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
        $majors = Major::where('status', 1)->get();
        $skills = Skill::where('status', 1)->get();
        $languages = Language::where('status', 1)->get();

        $time_exp = TimeExperience::where('status', 1)->orderBy('level')->get();
        $degrees = Degree::where('status', 1)->orderBy('level')->get();
        //lấy ra thông tin tất cả các skill có trong bài đăng 
        //pluck chỉ lấy ra id, kết quả trả về collection
        $skillActive = $post->skills->pluck('id')->toArray();
        //lấy ra jobpost_language của bài đnăg
        $job_post_language = JobPostlanguage::where('job_post_id', $post->id)->get();
        // dd($job_post_language);
        // dd($skillActive);
        return view('company.post.edit',
        ['post'=> $post, 'title'=>$title, 'majors'=>$majors, 'skills'=>$skills, 'time_exp'=>$time_exp,
         'degrees'=>$degrees, 'dataProvinces'=>$dataProvinces, 'skillActive'=>$skillActive, 'activeRoute'=>'post', 
        'job_post_language'=>$job_post_language, 'languages'=>$languages]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JobPostRequest $request, JobPost $post)
    {
        //dd($post);
        DB::beginTransaction();
        try {
            $job_post_id = $post->id;
            $skill=$request->skill;
            $post->update($request->all());
            //cập nhập dữ liệu trong bảng trung gian
            $post->skills()->sync($skill);
            //phần ngoại ngữ
            //sẽ lấy ra các ngoại ngữ khi sửa, chạy vòng lặp từng cái một, trong vòng lặp lại có 1 vòng lặp, 
            //chạy những ngoại ngữ cũ, nếu giống ngoại ngữ mới thì cập nhật level
            //còn những ngoại ngữ mới ko có trong bảng cũ thì p làm sao ???? sẽ xét array_in nếu ko có thì thêm mới
            
            //đầu tiên cần xóa bỏ những ngôn ngữ ko được giữ lại 
            //nếu có request language
            if($request->has('language_id')){
                $languageIds = $request->language_id;
                $language_levels = $request->language_level;
                for ($i = 0; $i < count($languageIds); $i++) {
                    $languageId = $languageIds[$i];
                    $languageLevel = $language_levels[$i];
            
                    // Tìm bản ghi theo job_post_id và language_id, nếu không tìm thấy thì tạo mới
                    // nếu tìm thấy thì update
                    JobPostLanguage::updateOrCreate(
                        ['job_post_id' => $job_post_id, 'language_id' => $languageId],
                        ['level' => $languageLevel]
                    );
                }
                
                //lấy ra những ngôn ngữ bị loại bỏ(có trong dữ liệu nhưng không có trong request thay đổi) để xóa bỏ
                 JobPostLanguage::where('job_post_id', $job_post_id)
                ->whereNotIn('language_id', $languageIds)
                ->delete();
            }
            else{
                //nếu ko có request sẽ xóa bỏ hết các ngôn ngữ ứng với bài đăng hiện tại
                JobPostLanguage::where('job_post_id', $job_post_id)->delete();
            }


            DB::commit();
            Session::flash('success', 'Sửa bài đăng thành công!');
            return Redirect()->route('company.postCreated');
        } catch (\Throwable $th) {
            DB::rollBack();
            Session::flash('error', 'Lỗi sửa!');
            return Redirect()->route('company.post.edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobPost $post)
    {
        try {
            $post->delete();
            return redirect()->route('company.post.index')->with('success', 'Xóa thành công');
        } catch (\Exception  $e) {
            return redirect()->back()->with('error', 'Xóa thất bại'.$e->getMessage());
        }
    }
    public function profileApply(string $id){
        $jobPost = JobPost::find($id);
        // $list_seekerProfile = $jobPost->seekerProfile()->paginate(10);
        $list_seekerProfile = $jobPost->applied()->paginate(10);
        // dd($list_seekerProfile);
        $name= $jobPost->title;
        $title = "Danh sách ứng tuyển - $name";
        return view('company.post.profileApply', 
        ['title' => $title, 'list_seekerProfile'=>$list_seekerProfile, 'activeRoute'=>'post', 'id'=>$id]);
    }
    //export excel
    public function exportProfileApply(string $id){
        $jobPost = JobPost::find($id);

        $name= $jobPost->title;
        $title = "Danh sách ứng tuyển - $name";
        return Excel::download(new ListProfileExport($id), $title.'.xlsx');
    }
    //bài đnăg hết hạn
    public function postExpired(){
        $company_id = auth('company')->user()->id;
        $list_jobs = JobPost::where('company_id', $company_id)->whereDate('end_date', '<', Carbon::now())->paginate(10);
        if($key = request()->key){
            $list_jobs = JobPost::where('company_id', $company_id)->where('title','like','%' . $key . '%')->whereDate('end_date', '<', Carbon::now())->paginate(10);
        }
        $title = "Danh sách các bài đăng đã hết hạn";
        return view('company.post.postExpired', 
        ['title' => $title, 'list_jobs'=>$list_jobs, 'activeRoute'=>'post']);
    }
    //những bài đăng tạo ở trạng thái đầu
    public function postCreated(){
        $company_id = auth('company')->user()->id;
        // $list_jobs = JobPost::where('company_id', $company_id)->where('status', 0)->orWhere('status', 2)->orWhere('status', 3)->orderBy('id', 'desc')->paginate(10);
        $query = JobPost::where('company_id', $company_id)
                    ->where(function ($q) {
                        $q->where('status', 0)
                          ->orWhere('status', 2)
                          ->orWhere('status', 3);
                    });
        // if($key = request()->key){
        //     $list_jobs = JobPost::where('company_id', $company_id)->where('status', 0)->orWhere('status', 2)->orWhere('status', 3)->where('title','like','%' . $key . '%')->paginate(10);
        // }
        if ($key = request()->key) {
            $query->where('title', 'like', '%' . $key . '%');
        }
        $list_jobs = $query->orderBy('id', 'desc')->paginate(10);
        $title = "Danh sách các bài đăng chưa kiểm duyệt";
        return view('company.post.postCreated', 
        ['title' => $title, 'list_jobs'=>$list_jobs, 'activeRoute'=>'post']);
    }
    //yêu cầu đăng bài
    public function status(Request $request, string $id){
        JobPost::where('id', $id)->update([
            'status' => 3,
            'date_request' => Carbon::now(),
        ]);
        return response()->json(['success'=>'Yêu cầu đăng bài thành công, sẽ được xem xét trong vòng 2 ngày']);
    }
}
