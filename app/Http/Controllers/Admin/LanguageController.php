<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\StoreSkillRequest;
use App\Http\Requests\Admin\LanguageRequest;
use App\Models\Language;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $major = Language::paginate(10);
        if($key = request()->key){
            $major = Language::where('name','like','%' . $key . '%')->paginate(10);
        }
        return view('admin.language.index', ['majors' => $major, 'title'=>"Danh sách ngôn ngữ"]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.language.add', ['title'=>"Thêm ngoại ngữ"]);
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LanguageRequest $request)
    {
        Language::create($request->all());
        return redirect()->route('admin.language.index')->with('success', 'thêm mới thành công');
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
    public function edit(Language $language)
    {
        
        return view('admin.language.edit', ['major'=>$language, 'title'=>"Sửa ngoại ngữ"]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LanguageRequest $request, Language $language)
    {
        $language->update($request->all());
        return redirect()->route('admin.language.index')->with('success', 'Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Language $language)
    {
        try {
            $language->delete();
            return redirect()->route('admin.language.index')->with('success', 'Xóa thành công');
        } catch (\Exception  $e) {
            return redirect()->back()->with('error', 'Xóa thất bại'.$e->getMessage());
        }
    }
    public function trash(){
        $major = Language::onlyTrashed()->paginate(10);
        return view('admin.language.trash',['majors' => $major, 'title'=>'thùng rác']);
    }
    public function restore(string $id){
        Language::withTrashed()->where('id', $id)->restore();
        return redirect()->route('admin.language.index')->with('success', 'Khôi phục thành công');
    }
    public function force(string $id){
        Language::withTrashed()->where('id', $id)->forceDelete();
        return redirect()->route('admin.language.trash')->with('success', 'Xóa thành công');

    }
    //trạng thái
    public function status(Request $request, string $id){
        $val = $request->status;
        language::where('id', $id)->update(['status' => $val]);
        return response()->json(['success'=>'cập nhật trạng thái thành công']);
    }
}
