<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobPost;
use App\Models\Major;
use App\Models\Skill;
use App\Models\TimeExperience;
use App\Models\Degree;
use App\Models\Language;
use App\Models\JobPostActivity;
use App\Models\JobPostLanguage;
use Carbon\Carbon;
use App\Http\Requests\Company\JobPostRequest;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;



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
    //duyệt bài đăng
    public function jobAccept(Request $request, string $id){
        JobPost::where('id', $id)->update([
            'status' => 1,
            'admin_id' => auth('admin')->user()->id,
            'allow_date'=>Carbon::now(),
        ]);
        return response()->json(['success'=>'Duyệt bài đăng thành công']);
    }
    //từ chối duyệt
    public function jobRefuse(Request $request){
        try{
            $rules = [
                'reason' => 'required',
            ];
            $messages =  [
                'reason.required' => 'Vui lòng nhập lý do',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            //trả về json để tránh load lại trang, để khi có lỗi nó không đóng model
            if ($validator->fails()) {
                return response()->json(['error'=>$validator->errors()]);
            }
            JobPost::where('id', $request->post_id)->update([
                'status' => 2,
                'reason'=>$request->reason,
            ]);
            return response()->json(['success'=>'Duyệt bài đăng thành công']);
            // Session::flash('success', 'Tạo thành công!');
            // return redirect()->route('profile');
        } catch(\Exception  $e){
            return response()->json(['error'=>'Từ chối thất bại'.$e->getMessage()]);
            // return redirect()->back()->with('error', 'Từ chối thất bại'.$e->getMessage());
        }
    }

    
    public function index()
    {
        $job = JobPost::where('status', 1)->whereDate('end_date', '>', Carbon::now())->whereHas('company', function($query) {
            $query->where('status', 1)
            ->where('deleted_at', NULL);
        })->orderBy('allow_date', 'desc')->paginate(10);
        if($key = request()->key){
            $job = JobPost::where('status',1)->whereDate('end_date', '>', Carbon::now())->where('title','like','%' . $key . '%')->whereHas('company', function($query) {
                $query->where('status', 1)
                ->where('deleted_at', NULL);
            })->orderBy('allow_date', 'desc')->paginate(10);
        }
        return view('admin.post.index', ['companies' => $job, 'title'=>"Danh sách các công việc đang hoạt động"]);
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
        $title = "Sửa bài đăng";
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
        return view('admin.post.edit',
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
            return Redirect()->route('admin.post.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Session::flash('error', 'Lỗi sửa!');
            return Redirect()->route('admin.post.edit');
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
