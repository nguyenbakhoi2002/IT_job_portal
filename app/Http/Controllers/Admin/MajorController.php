<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\StoreSkillRequest;
use App\Http\Requests\Admin\EditSkillRequest;
use App\Models\Major;


class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $major = Major::paginate(5);
        if($key = request()->key){
            $major = Major::where('name','like','%' . $key . '%')->paginate(10);
        }
        return view('admin.major.index', ['majors' => $major, 'title'=>"Danh sách chuyên ngành"]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('admin.major.add', ['title'=>"Thêm chuyên ngành"]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSkillRequest $request)
    {
        Major::create($request->all());
        return redirect()->route('admin.major.index')->with('success', 'thêm mới thành công');
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
    public function edit(Major $major)
    {
        
        return view('admin.major.edit', ['major'=>$major, 'title'=>"Sửa kĩ năng"]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditSkillRequest $request, Major $major)
    {
        $major->update($request->all());
        return redirect()->route('admin.major.index')->with('success', 'Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Major $major)
    {
        try {
            $major->delete();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Exception  $e) {
            return redirect()->back()->with('error', 'Xóa thất bại'.$e->getMessage());
        }
    }
    public function trash(){
        $major = Major::onlyTrashed()->paginate(10);
        return view('admin.major.trash',['majors' => $major, 'title'=>'thùng rác']);
    }
    public function restore(string $id){
        Major::withTrashed()->where('id', $id)->restore();
        return redirect()->route('admin.major.index')->with('success', 'Khôi phục thành công');
    }
    public function force(string $id){
        Major::withTrashed()->where('id', $id)->forceDelete();
        return redirect()->route('admin.major.trash')->with('success', 'Xóa thành công');

    }
    //trạng thái
    public function status(Request $request, string $id){
        $val = $request->status;
        Major::where('id', $id)->update(['status' => $val]);
        return response()->json(['success'=>'cập nhật trạng thái thành công']);
    }
}
