<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Major;
use App\Models\Skill;
use App\Models\SeekerProfile;
use App\Models\Education;
use App\Models\SeekerSkill;
use App\Models\SeekerLanguage;
use App\Models\Experience;
use App\Models\Degree;
use App\Models\Project;
use App\Models\Language;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Client\Profile\InfoRequest;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;



class ProfileController extends Controller
{
    private $message_val;
    public function __construct()
    {
        $this->v = [];
        $this->message_val = [
            'name.required' => 'Vui lòng nhập tên',
            'title.required' => 'Vui lòng nhập tiêu đề',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'address.required' => 'Vui lòng nhập địa chỉ',
            'phone.numeric' => 'Số điện thoại phải là số',
            //'phone.digits' => 'có 10 kí tự',
            'email.required' => 'Vui lòng nhập email!',
            'objectice.required' => 'không được bỏ trống',
            'hinhanh_upload_logo.mimes' => 'Ảnh phải thuộc định dạng jpg, png, jpeg!',
            'hinhanh_upload_logo.max' => 'Ảnh nhập không quá 5mb!',


            'company_name.required' => 'Vui lòng nhập tên công ty!',
            'work_position.required' => 'Vui lòng nhập vị trí!',
            'start_date.required' => 'Vui lòng nhập ngày bắt đầu!',
            'end_date.required' => 'Vui lòng nhập ngày kết thúc!',
            'end_date.after' => 'Vui lòng nhập ngày kết thúc > ngày bắt đầu',
            'description.required' => 'Vui lòng nhập mô tả!',



            'image.required' => 'Vui lòng up ảnh!',
            'image.image' => 'Chọn file ảnh!',
            'image.mimes' => 'Chọn file ảnh có định dạng jpg,png,jpeg!',
            'image.max' => 'Chọn ảnh có kích thước nhỏ hơn 5mb!',
            'name_education.required' => 'Vui lòng nhập tên trường!',
            'majors.required' => 'Vui lòng nhập ngành học!',
            'end_date.required' => 'Vui lòng nhập ngày kết thúc!',
            'skill_id.required' => 'Vui lòng chọn kỹ năng!',
            'gpa.max' => 'Điểm không quá 10!',
            'time.required' => 'Vui lòng nhập thời gian!',
        ];
    }
    public function index(){
        $maJor = Major::where('status', '1')->get();
        $skills = Skill::all();
        //lấy ra những các status bằng 1 thôi
        $degrees = Degree::where('status', '1')->get();
        $languages = Language::all();
        
        $seeker = SeekerProfile::where('id', 1)->first();
        if (!empty($seeker)) {
            $experiences = Experience::where('seeker_profile_id', $seeker->id)->get();
            $educations = Education::where('seeker_profile_id', $seeker->id)->get();
            $list_skill = SeekerSkill::where('seeker_profile_id', $seeker->id)->get();
            $list_language = SeekerLanguage::where('seeker_profile_id', $seeker->id)->get();
            // $certificates= Certificate::where('seeker_id', $seeker->id)->get();
            $projects =  Project::where('seeker_profile_id', $seeker->id)->get();
            //active skills
            $skillActive = $list_skill->pluck('skill_id')->toArray();

        }
        return view('client.profile.add', 
        ['maJor'=>$maJor, 'seeker'=>$seeker, 'skills'=>$skills,'languages'=>$languages,'degrees'=>$degrees ,
         'experiences'=>$experiences,'projects' =>$projects , 'educations'=>$educations, 'skillActive'=>$skillActive,
          'list_language'=>$list_language ]);
    }

    //lưu thay đổi thông tin các nhân
    public function updateInfo(Request $request)
    {
        try{
            $rules = [
                'name' => 'required',
                'title' => 'required',
                'phone' => 'required|numeric',
                'email' => 'required',
                'objective' => 'required',
                'hinhanh_upload_logo' => 'image|mimes:jpg,png,jpeg|max:5000',
                'address' => 'required',          
            ];
            $messages =  $this->message_val;
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return response()->json(['error'=>$validator->errors()]);
            }
            $file_name_logo="";
            $candidate_name=Str::slug($request->name);
            if($request->has('hinhanh_upload_logo')){
                $file = $request->hinhanh_upload_logo;
                //lấy đuôi ảnh
                $ext = $file->extension();
                $file_name_logo = time()."-imageCV-".$candidate_name.".".$ext;
                //lưu file vào thư mục
                $file->move(public_path('uploads/images/candidate'), $file_name_logo);
            }else{
                $file_name_logo =$request->hinhanh_upload_logo_hd;
            }   
            $request->merge(['image'=>$file_name_logo ]);
            // dd($request->all());
            // $request->merge(['password'=>Hash::make($request->password)]);
            $seekerProfile = SeekerProfile::findOrFail($request->id); 
            $info = $seekerProfile->update($request->all());
            //  dd($info);
            if ($info == null) {
                return response()->json([
                    'is_check' => false,
                    'error' => 'Tạo mới thất bại!'
                ]);
            }
            if ($info == 1) {
                    return response()->json([
                    'is_check' => true,
                    'success' => 'Tạo mới thành công!',
                    'data' => $request->all(),
                    'redirect_url' => route('profile'),
                ]);
            } else {
                return response()->json([
                    'is_check' => false,
                    'error' => 'Lỗi tạo mới!'
                ]);
            }
            // Session::flash('success', 'cập nhật thành công!');
            // return Redirect()->route('profile');
            //  return redirect()->route('profile')->with('success', 'sửa thành công');
        } catch(\Exception  $e){
            return redirect()->back()->with('error', 'thêm mới thất bại'.$e->getMessage());
        }
    }
    //experiencer  
    public function createExperience(Request $request){
        $seeker_id = $request->seeker_profile_id;
        
        
        // dd($seeker_id);
        DB::beginTransaction();
        try{
            $check_max = Experience::where('seeker_profile_id', $seeker_id)->count();
        if($check_max >= 5) {
            return response()->json([
                'is_max' => true,
                'error' => 'Tối đa 5 mục kinh nghiệm!'
            ]);
        }else {
            $rules = [
                'company_name' => 'required',
                'work_position' => 'required',
                'start_date' => 'required',
                'end_date' => 'required|after:start_date',
                'description' => 'required',
            ];
            $messages =  $this->message_val;
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                DB::rollBack();
                return response()->json(['error'=>$validator->errors()]);
            }else 
            {

                $bat_dau = strtotime($request->start_date);
                $ket_thuc = strtotime($request->end_date);
                // if(empty($ket_thuc)){ 
                //     //nếu không nhập giá trị thì coi như vẫn đang làm việc->lấy luôn ngày hiện tại  
                //     $ket_thuc = Carbon::now()->toDateTimeString();
                // }
                // $ket_thuc = strtotime($ket_thuc);
                $tong = $ket_thuc - $bat_dau;
                //chuyển đổi thời  gian từ giây thành ngày rồi làm tròn xuống
                $day = floor($tong / 60 / 60 / 24);
                //chuyển đổi  thời gian từ ngày thành năm,lấy 1 chữ số thập phân
                $day = round($day /30/12, 1);
                // dd($request->all());
                $experience=Experience::create($request->all());
                //cập nhật trường kinh nghiệm trong seeker_profile
                $seeker = SeekerProfile::where('id', $seeker_id)->first();
                $total_exp = $seeker->total_experience + $day;
                $seeker->update([
                    'total_experience' => $total_exp,
                ]);
                if ($experience == null || $experience == false) {
                    DB::rollBack();
                    return response()->json([
                        'is_check' => false,
                        'error' => 'Lỗi'
                    ]);
                }
                elseif ($experience == true) {
                    DB::commit();
                    return response()->json([
                        'is_check' => true,
                        'success' => 'Tạo mới thành công!',
                    ]);
                } 
            }
        }
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json([
                'is_check' => false,
                'error' => 'Lỗi' . $e->getMessage(),
            ]);
    
        }
    }
    public function updateExperience(Request $request,string $id){
        


        // dd($id);
        //DB::beginTransaction();
        try{
            $seeker_id = $request->seeker_profile_id;

            $rules = [
                'company_name' => 'required',
                'work_position' => 'required',
                'start_date' => 'required',
                'end_date' => 'required|after:start_date',
                'description' => 'required',
            ];
            $messages =  $this->message_val;
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                //DB::rollBack();
                return response()->json(['error'=>$validator->errors()]);
            }else 
            {
                $experience = Experience::findOrFail($id); 
                $bat_dau_old=strtotime($experience->start_date);
                $ket_thuc_old=strtotime($experience->end_date);
                $tong_old = $ket_thuc_old - $bat_dau_old;
                $day_old = floor($tong_old / 60 / 60 / 24);
                $day_old = round($day_old /30/12, 1);


                // mới
                $bat_dau = strtotime($request->start_date);
                $ket_thuc = strtotime($request->end_date);
                
                $tong = $ket_thuc - $bat_dau;
                //chuyển đổi thời  gian từ giây thành ngày rồi làm tròn xuống
                $day = floor($tong / 60 / 60 / 24);
                //chuyển đổi  thời gian từ ngày thành năm,lấy 1 chữ số thập phân
                $day = round($day /30/12, 1);
                //update kinh nghiệm   
                $exp = $experience->update($request->all());
                // dd($experience);
                //update trường tổng kinh nghiệm trong seeker_profile

                $seeker = SeekerProfile::where('id', $seeker_id)->first();

                $total_exp = $seeker->total_experience - ($day_old?$day_old:0) + ($day?$day:0);
                $seeker->update([
                    'total_experience' => $total_exp,
                ]);
                //DB::commit();
                 
                if ($exp == null) {
                    return response()->json([
                        'is_check' => false,
                        'error' => 'Cập nhật thất bại!'
                    ]);
                }
                if ($exp == 1) {
                    return response()->json([
                        'is_check' => true,
                        'success' => 'Cập nhật thành công!',
                    ]);
                } else {
                    return response()->json([
                        'is_check' => false,
                        'error' => 'Lỗi tạo mới!'
                    ]);
                }
                // dd($experience);
                
            }
            }catch(\Exception $e){
                //DB::rollBack();
                return response()->json([
                    'is_check' => false,
                    'error' => 'Lỗi' . $e->getMessage(),
                ]);
                
            }
    }
}
