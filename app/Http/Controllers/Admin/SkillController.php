<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\StoreSkillRequest;
use App\Http\Requests\Admin\EditSkillRequest;
use App\Models\Skill;
use App\Models\JobPostSkill;
use App\Models\SeekerSkill;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function __construct(){
    //     $this->v = [];
    // }
    public function __construct()
    {
        // Áp dụng middleware 'custom' cho các phương thức 'update' và 'destroy'
        $this->middleware(['checkAdminType'])->only(['update', 'destroy']);
    }
    public function index()
    {
        $skill = Skill::paginate(10);
        if($key = request()->key){
            $skill = Skill::where('name','like','%' . $key . '%')->paginate(10);
        }
        return view('admin.skill.index', ['skills' => $skill, 'title'=>"Danh sách kĩ năng"]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('admin.skill.add', ['title'=>"Thêm kĩ năng"]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSkillRequest $request)
    {
        Skill::create($request->all());
        return redirect()->route('admin.skill.index')->with('success', 'thêm mới thành công');
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
    public function edit(Skill $skill)
    {
        
        return view('admin.skill.edit', ['skill'=>$skill, 'title'=>"Sửa kĩ năng"]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditSkillRequest $request, Skill $skill)
    {
        $skill->update($request->all());
        return redirect()->route('admin.skill.index')->with('success', 'Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill)
    {
        try {
            $skill->delete();
            return redirect()->route('admin.skill.index')->with('success', 'Xóa thành công');
        } catch (\Exception  $e) {
            return redirect()->back()->with('error', 'Xóa thất bại'.$e->getMessage());
        }
    }
    public function trash(){
        $skill = Skill::onlyTrashed()->paginate(10);
        if($key = request()->key){
            $skill = Skill::onlyTrashed()->where('name','like','%' . $key . '%')->paginate(10);
        }
        return view('admin.skill.trash',['skills' => $skill, 'title'=>'thùng rác']);
    }
    public function restore(string $id){
        Skill::withTrashed()->where('id', $id)->restore();
        return redirect()->route('admin.skill.index')->with('success', 'Khôi phục thành công');
    }
    public function force(string $id){
        if(auth('admin')->user()->type==0)
            return redirect()->route('admin.skill.trash')->with('error', 'Bạn không có quyền xóa dữ liệu');
        //đếm xem có bảng nào tham chiếu đến chuyên ngành này không
        $count_seeker_skill = SeekerSkill::where('skill_id',$id)->get()->count();
        $count_job_post_skill = JobPostSkill::where('skill_id',$id)->get()->count();
        if($count_seeker_skill || $count_job_post_skill)
            return redirect()->route('admin.skill.trash')->with('error', 'Không thể xóa, sẽ lỗi trang web');
        Skill::withTrashed()->where('id', $id)->forceDelete();
        return redirect()->route('admin.skill.trash')->with('success', 'Xóa thành công');

    }
    public function status(Request $request, string $id){
        $val = $request->status;
        Skill::where('id', $id)->update(['status' => $val]);
        return response()->json(['success'=>'cập nhật trạng thái thành công']);
   
    
}
}
