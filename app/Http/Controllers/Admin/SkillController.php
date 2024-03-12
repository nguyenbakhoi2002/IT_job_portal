<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\StoreSkillRequest;
use App\Http\Requests\Admin\EditSkillRequest;
use App\Models\Skill;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function __construct(){
    //     $this->v = [];
    // }
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
        Skill::withTrashed()->where('id', $id)->forceDelete();
        return redirect()->route('admin.skill.trash')->with('success', 'Xóa thành công');

    }
}
