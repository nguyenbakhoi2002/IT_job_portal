<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\DegreeRequest;
use App\Models\Degree;

class DegreeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Bằng cấp';
        $degrees = Degree::orderBy('status', 'desc')->orderBy('level')->paginate(10);
        if($key = request()->key){
        $degrees = Degree::where('name', 'like', '%'.$key.'%')->orderBy('level')->paginate(10);

        }
        return view('admin.request.degree.index', ['title' => $title, 'degrees' => $degrees]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Thêm Bằng cấp';

        return view('admin.request.degree.add', ['title' => $title]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DegreeRequest $request)
    {
        try {
            Degree::create($request->all());
            return redirect()->route('admin.degree.index')->with('success', 'thêm mới thành công');
        } catch (\Throwable $th) {
            return redirect()->route('admin.degree.create')->with('success', 'Thêm mới thất bại');
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
    public function edit(Degree $degree)
    {
        $title = 'sửa bằng cấp';
        return view('admin.request.degree.edit', ['degree'=>$degree ,'title'=>$title]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DegreeRequest $request, Degree $degree)
    {
        try {
            $degree->update($request->all());
            return redirect()->route('admin.degree.index')->with('success', 'sửa thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'sửa thất bại'.$e->getMessage());

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Degree $degree)
    {
        try {
            $degree->delete();
            return redirect()->route('admin.degree.index')->with('success', 'xóa thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'xóa thất bại'.$e->getMessage());
        }
    }
    public function trash(){
        $title = 'Bằng cấp - Thùng rác';
        $degree = Degree::onlyTrashed()->paginate(10);
        if($key = request()->key){
            $degree = Degree::onlyTrashed()->where('name', 'like', '%'.$key.'%')->paginate(10);
        }
        return view('admin.request.degree.trash', ['degrees' => $degree, 'title' => $title]);
    }
    public function restore(string $id){
        Degree::withTrashed()->where('id', $id)->restore();
        return redirect()->route('admin.degree.index')->with('success', 'Khôi phục thành công');
    }
    public function force(string $id){
        Degree::withTrashed()->where('id', $id)->forceDelete();
        // return response()->json(['success'=>'Xóa thành công!']);
        return redirect()->route('admin.degree.trash')->with('success', 'Xóa thành công');


    }
    //trạng thái
    public function status(Request $request, string $id){
        $val = $request->status;
        Degree::where('id', $id)->update(['status' => $val]);
        return response()->json(['success'=>'cập nhật trạng thái thành công']);
    }
}
