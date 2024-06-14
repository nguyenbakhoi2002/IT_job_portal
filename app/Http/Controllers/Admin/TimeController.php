<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TimeExperience;
use App\Models\JobPost;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\DegreeRequest;
use App\Http\Requests\Admin\TimeRequest;


class TimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        // Áp dụng middleware 'custom' cho các phương thức 'update' và 'destroy'
        $this->middleware(['checkAdminType'])->only(['update', 'destroy']);
    }
    public function index()
    {
        $title = 'Kinh nghiệm';
        $degrees = TimeExperience::orderBy('status', 'desc')->orderBy('level')->paginate(10);
        if($key = request()->key){
        $degrees = TimeExperience::where('name', 'like', '%'.$key.'%')->orderBy('level')->paginate(10);

        }
        return view('admin.request.time.index', ['title' => $title, 'degrees' => $degrees]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Thêm thời gian kinh nghiệm';

        return view('admin.request.time.add', ['title' => $title]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TimeRequest $request)
    {
        try {
            TimeExperience::create($request->all());
            return redirect()->route('admin.time.index')->with('success', 'thêm mới thành công');
        } catch (\Throwable $th) {
            return redirect()->route('admin.time.create')->with('success', 'Thêm mới thất bại');
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
    public function edit(TimeExperience $time)
    {
        $title = 'sửa kinh nghiệm';
        return view('admin.request.time.edit', ['degree'=>$time ,'title'=>$title]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TimeRequest $request, TimeExperience $time)
    {
        try {
            $time->update($request->all());
            return redirect()->route('admin.time.index')->with('success', 'sửa thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'sửa thất bại'.$e->getMessage());

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TimeExperience $time)
    {
        try {
            $time->delete();
            return redirect()->route('admin.time.index')->with('success', 'xóa thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'xóa thất bại'.$e->getMessage());
        }
    }
    public function trash(){
        $title = 'Kinh nghiệm - Thùng rác';
        $degree = TimeExperience::onlyTrashed()->paginate(10);
        if($key = request()->key){
            $degree = TimeExperience::onlyTrashed()->where('name', 'like', '%'.$key.'%')->paginate(10);
        }
        return view('admin.request.time.trash', ['degrees' => $degree, 'title' => $title]);
    }
    public function restore(string $id){
        TimeExperience::withTrashed()->where('id', $id)->restore();
        return redirect()->route('admin.time.index')->with('success', 'Khôi phục thành công');
    }
    public function force(string $id){
        if(auth('admin')->user()->type==0)
            return redirect()->route('admin.time.trash')->with('error', 'Bạn không có quyền xóa dữ liệu');
        //đếm xem có bảng nào tham chiếu đến chuyên ngành này không
        // $count_edu = Education::where('major_id',$id)->get()->count();
        $count_job_post = JobPost::where('time_exp_id',$id)->get()->count();
        if($count_job_post)
            return redirect()->route('admin.time.trash')->with('error', 'Không thể xóa, sẽ lỗi trang web');
        TimeExperience::withTrashed()->where('id', $id)->forceDelete();
        // return response()->json(['success'=>'Xóa thành công!']);
        return redirect()->route('admin.time.trash')->with('success', 'Xóa thành công');


    }
    //trạng thái
    public function status(Request $request, string $id){
        $val = $request->status;
        TimeExperience::where('id', $id)->update(['status' => $val]);
        return response()->json(['success'=>'cập nhật trạng thái thành công']);
    }
}
