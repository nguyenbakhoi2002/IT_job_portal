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
use Illuminate\Support\Facades\Auth;
//sử dụng xuẩ pdf
use Barryvdh\DomPDF\Facade\Pdf;


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
            'end_date.before' => 'Vui lòng nhập kết thúc bé hơn ngày hiện tại',

            'start_date.before' => 'Vui lòng nhập bắt đầu bé hơn ngày hiện tại',
            'description.required' => 'Vui lòng nhập mô tả!',

            'school_name.required' => 'Vui lòng nhập tên trường',
            'major_id.required'=>'Vui lòng chọn chuyên ngành',
            'degree_id.required' => 'vui lòng chọn bằng cấp',
            //skill
            'skill.required' => 'Bạn không thể để trống trường dữ liệu này',
            //ngoại ngữ
            'language_id.required' => 'Vui lòng chọn ngôn ngữ',
            'level.required' => 'Vui lòng chọn cấp độ',
            'certificate.required' => 'Vui lòng điền chứng chỉ',

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
        $degrees = Degree::where('status', '1')->where('id','<>','1')->orderBy('level', 'asc')->get();
        $languages = Language::all();
        //lấy ra id của người đang đăng nhập
        $candidate_id  = auth('candidate')->user()->id;
        $seeker = SeekerProfile::where('candidate_id', $candidate_id)->where('is_clone', 0)->first();
        // if(empty($seeker)){
        //     return response()->json(['hasSeekerProfile' => false]);
        // }
        $experiences=[];
        $projects=[];
        $educations=[];
        $skillActive=[];
        $list_language=[];
        $count_skill=0;
        if(!empty($seeker)){
            $experiences = Experience::where('seeker_profile_id', $seeker->id)->get();
            $educations = Education::where('seeker_profile_id', $seeker->id)->get();
            $list_skill = SeekerSkill::where('seeker_profile_id', $seeker->id)->get();
            //nếu đã có skill thì thực hiện cập nhật, còn chưa thì thực hiện tạo mới, logic được viết trong hàm saveSkills
            $count_skill = $list_skill->count();
            // dd($count_skill);
            $list_language = SeekerLanguage::where('seeker_profile_id', $seeker->id)->get();
            // $certificates= Certificate::where('seeker_id', $seeker->id)->get();
            $projects =  Project::where('seeker_profile_id', $seeker->id)->get();
            //active skills
            $skillActive = $list_skill->pluck('skill_id')->toArray();

        }
        return view('client.profile.add', 
        ['maJor'=>$maJor, 'seeker'=>$seeker, 'skills'=>$skills,'languages'=>$languages,'degrees'=>$degrees ,
         'experiences'=>$experiences,'projects' =>$projects , 'educations'=>$educations, 'skillActive'=>$skillActive,
          'list_language'=>$list_language, 'count_skill'=>$count_skill ]);
    }
    //tạo cv bắt đầu bằng tên tiều đè
    public function createProfile(Request $request){
        try{
            $rules = [
                'title' => 'required',
            ];
            $messages =  $this->message_val;
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return response()->json(['error'=>$validator->errors()]);
            }
            $seekerProfile=SeekerProfile::create($request->all());
            return response()->json([
                'is_check'=>true,
                'success' => 'Tạo mới thành công!',
                'redirect_url' => route('profile'),
            ]);
            
            
        } catch(\Exception  $e){
            return redirect()->back()->with('error', 'thêm mới thất bại'.$e->getMessage());
        }
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
                'start_date' => 'required|before:now',
                'end_date' => 'required|after:start_date|before:now',
                // 'start_date' => 'required',
                // 'end_date' => 'required|after:start_date',
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
                'start_date' => 'required|before:now',
                'end_date' => 'required|after:start_date|before:now',

                // 'start_date' => 'required',
                // 'end_date' => 'required|after:start_date',
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
    public function deleteExperience(Request $request, string $id)
    {
        // $id = $request->id;
        // dd($id);

        try{
            $exp = Experience::find($id);

            // if(!isset($exp)){
            //     return redirect()->route('CreateCV');
            // }
            $bat_dau = strtotime($exp->start_date);
            $ket_thuc = strtotime($exp->end_date);

            $tong = $ket_thuc - $bat_dau;

            $day = floor($tong / 60 / 60 / 24);

            $day = round($day /30/12, 1);

            $seeker = SeekerProfile::where('id', $exp->seeker_profile_id)->first();
            $total_exp = $seeker->total_experience - ($day?$day:0);
            $seeker->update([
                'total_experience' => $total_exp,
            ]);

            $exp->delete();
            return response()->json([
                'is_check' => true,
                'success' => 'Xóa thành công!',
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                'is_check' => false,
                'error' => 'Xóa thất bại!'
            ]);
        }
        
    }
    //Các dự án cá nhân
    public function createProject(Request $request){
        $seeker_id = $request->seeker_profile_id;
        try{
            $check_max = Project::where('seeker_profile_id', $seeker_id)->count();
        if($check_max >= 5) {
            return response()->json([
                'is_max' => true,
                'error' => 'Bạn chỉ được phép thêm 5 sản phẩm nổi bật!'
            ]);
        }else {
            $rules = [
                'name' => 'required',
                'start_date' => 'required|before:now',
                'end_date' => 'required|after:start_date|before:now',

                // 'start_date' => 'required',
                // 'end_date' => 'required|after:start_date',
                'description' => 'required',
            ];
            $messages =  $this->message_val;
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return response()->json(['error'=>$validator->errors()]);
            }else 
            {
                $project=Project::create($request->all());
                if ($project == null || $project == false) {
                    return response()->json([
                        'is_check' => false,
                        'error' => 'Lỗi'
                    ]);
                }
                elseif ($project == true) {
                    return response()->json([
                        'is_check' => true,
                        'success' => 'Tạo mới thành công!',
                    ]);
                } 
            }
        }
        }catch(\Exception $e){
            return response()->json([
                'is_check' => false,
                'error' => 'Lỗi' . $e->getMessage(),
            ]);
    
        }
    }
    //cập nhật dự án cá nhân
    public function updateProject(Request $request,string $id){

        try{
            $seeker_id = $request->seeker_profile_id;

            $rules = [
                'name' => 'required',
                'start_date' => 'required|before:now',
                'end_date' => 'required|after:start_date|before:now',


                // 'start_date' => 'required',
                // 'end_date' => 'required|after:start_date',
                'description' => 'required',
            ];
            $messages =  $this->message_val;
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return response()->json(['error'=>$validator->errors()]);
            }else 
            {
                $project = Project::findOrFail($id); 
                //update dự án  
                $pj = $project->update($request->all());
                if ($pj == null) {
                    return response()->json([
                        'is_check' => false,
                        'error' => 'Cập nhật thất bại!'
                    ]);
                }
                if ($pj == 1) {
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
            }
            }catch(\Exception $e){
                return response()->json([
                    'is_check' => false,
                    'error' => 'Lỗi' . $e->getMessage(),
                ]);
                
            }
    }
    //xóa dự án cá nhân
    public function deleteProject(Request $request, string $id)
    {
        try{
            $exp = Project::find($id);
            $exp->delete();
            return response()->json([
                'is_check' => true,
                'success' => 'Xóa thành công!',
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                'is_check' => false,
                'error' => 'Xóa thất bại!'
            ]);
        }
        
    }
    //thêm học vấn (education)
    public function createEducation(Request $request){
        $seeker_id = $request->seeker_profile_id;
        try{
            $check_max = Education::where('seeker_profile_id', $seeker_id)->count();
        if($check_max >= 3) {
            return response()->json([
                'is_max' => true,
                'error' => 'Bạn chỉ được phép thêm 3 trường học nổi bật nhất có liên quan đến ngành công nghệ thông tin!'
            ]);
        }else {
            $rules = [
                'school_name' => 'required',
                'start_date' => 'required|before:now',
                'end_date' => 'nullable|after:start_date|before:now',
                'major_id'=>'required',
                'degree_id' => 'required',
                'description' => 'required',
            ];
            $messages =  $this->message_val;
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return response()->json(['error'=>$validator->errors()]);
            }else 
            {
                $education=Education::create($request->all());
                if ($education == null || $education == false) {
                    return response()->json([
                        'is_check' => false,
                        'error' => 'Lỗi'
                    ]);
                }
                elseif ($education == true) {
                    return response()->json([
                        'is_check' => true,
                        'success' => 'Tạo mới thành công!',
                    ]);
                } 
            }
        }
        }catch(\Exception $e){
            return response()->json([
                'is_check' => false,
                'error' => 'Lỗi' . $e->getMessage(),
            ]);
    
        }
    }
    //cập nhật học vấn
    public function updateEducation(Request $request,string $id){

        try{
            $seeker_id = $request->seeker_profile_id;

            $rules = [
                'school_name' => 'required',
                'start_date' => 'required|before:now',
                'end_date' => 'nullable|after:start_date|before:now',
                
                'major_id'=>'required',
                'degree_id' => 'required',
                //nullable là vẫn cho phép null
                'description' => 'required',
            ];
            $messages =  $this->message_val;
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return response()->json(['error'=>$validator->errors()]);
            }else 
            {
                $ducation = Education::findOrFail($id); 
                //update dự án  
                $edu = $ducation->update($request->all());
                if ($edu == null) {
                    return response()->json([
                        'is_check' => false,
                        'error' => 'Cập nhật thất bại!'
                    ]);
                }
                if ($edu == 1) {
                    return response()->json([
                        'is_check' => true,
                        'success' => 'Cập nhật thành công!',
                    ]);
                } else {
                    return response()->json([
                        'is_check' => false,
                        'error' => 'Lỗi cập nhật!'
                    ]);
                }
            }
            }catch(\Exception $e){
                return response()->json([
                    'is_check' => false,
                    'error' => 'Lỗi' . $e->getMessage(),
                ]);
                
            }
    }
    //xóa học vấn
    public function deleteEducation(Request $request, string $id)
    {
        try{
            $edu = Education::find($id);
            $edu->delete();
            return response()->json([
                'is_check' => true,
                'success' => 'Xóa thành công!',
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                'is_check' => false,
                'error' => 'Xóa thất bại!'
            ]);
        }
        
    }
    public function saveSkills(Request $request)
    {
        $seeker_profile_id = $request->seeker_profile_id;
        //lấy ra seeker_profile_hiện tại;
        $rules = [
            'skill' => 'required',
        ];
        $messages =  $this->message_val;
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()]);
        }else{
            $seeker_profile = SeekerProfile::findOrFail($seeker_profile_id);
            $skills=$request->skill;

            if($request->count_skill>0){
                //thực hiện cập nhật
                $result=$seeker_profile->skills()->sync($skills);
                //hình như $result không trả về giá trị true false, nó sẽ luôn trả về một mảng có 3 phần tử
                // if ($result) {
                    return response()->json([
                        'is_check' => true,
                        'success' => 'Cập nhật thành công!'
                    ]);
                // } else {
                //     return response()->json([
                //         'is_check' => false,
                //         'error' => 'Cập nhật thất bại!'
                //     ]);
                // }
                
            }else{
                //thực hiện tạo mới
                $result=$seeker_profile->skills()->attach($skills);
                //hình như $result không trả về giá trị, nên không thể if được
                return response()->json([
                    'is_check' => true,
                    'success' => 'Cập nhật thành công!'
                ]);
                

            }
        }
        
    }
    public function DeleteAllSkill(string $seeker_profile_id)
    {   
        try{
            $seeker_profile = SeekerProfile::findOrFail($seeker_profile_id);
            $seeker_profile->skills()->sync([]);
            Session::flash('success', 'Xóa thành công!');
            return redirect()->back();
        }catch(\Exception  $e){
            Session::flash('erorr', 'Xóa thất bại!');
            redirect()->back();
        }
        
    }
    //ngôn ngữ (language)
    public function createLanguage(Request $request){
        $seeker_profile_id = $request->seeker_profile_id;
        try{
            $rules = [
                'language_id' => 'required',
                'level' => 'required',
                'certificate' => 'required',
                
            ];
            $messages =  $this->message_val;
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return response()->json(['error'=>$validator->errors()]);
            }else 
            {
                $seeker_profile = SeekerProfile::findOrFail($seeker_profile_id);
                $seeker_language=SeekerLanguage::create($request->all());
                if ($seeker_language == null || $seeker_language == false) {
                    return response()->json([
                        'is_check' => false,
                        'error' => 'Lỗi'
                    ]);
                }
                elseif ($seeker_language == true) {
                    return response()->json([
                        'is_check' => true,
                        'success' => 'Tạo mới thành công!',
                    ]);
                } 
                
            }
        }catch(\Exception $e){
            return response()->json([
                'is_check' => false,
                'error' => 'Lỗi' . $e->getMessage(),
            ]);
        }
    }
    //sửa ngôn ngữ
    public function updateLanguage(Request $request,string $id){
        // dd($id);
        // dd($request->all());
        try{
            $seeker_id = $request->seeker_profile_id;

            $rules = [
                'language_id' => 'required',
                'level' => 'required',
                'certificate' => 'required',
            ];
            $messages =  $this->message_val;
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return response()->json(['error'=>$validator->errors()]);
            }else 
            {
                //lấy ra bản ghi cần sửa
                $seeker_language = Seekerlanguage::findOrFail($id); 
                //update language
                $seeker_language = $seeker_language->update($request->all());
                if ($seeker_language == null) {
                    return response()->json([
                        'is_check' => false,
                        'error' => 'Cập nhật thất bại!'
                    ]);
                }
                if ($seeker_language == 1) {
                    return response()->json([
                        'is_check' => true,
                        'success' => 'Cập nhật thành công!',
                    ]);
                } else {
                    return response()->json([
                        'is_check' => false,
                        'error' => 'Lỗi cập nhật!'
                    ]);
                }
            }
            }catch(\Exception $e){
                return response()->json([
                    'is_check' => false,
                    'error' => 'Lỗi' . $e->getMessage(),
                ]);
                
            }
    }
    //xóa ngôn ngữ
    public function deleteLanguage(Request $request, string $id)
    {
        try{
            $seeker_language = Seekerlanguage::find($id);
            $seeker_language->delete();
            return response()->json([
                'is_check' => true,
                'success' => 'Xóa thành công!',
            ]);
        }
        catch(\Exception $e){
            return response()->json([
                'is_check' => false,
                'error' => 'Xóa thất bại!'
            ]);
        }
        
    }

    //xem trước hồ sơ (preview)
    public function profilePreview(SeekerProfile $seeker_profile){
        return view('client.profile.template_new', ['seeker_profile' => $seeker_profile]);
    }
    //export hồ sơ PDF
    public function exportProfile(SeekerProfile $seeker_profile){
        // return view('client.profile.export_pdf', ['seeker' => $seeker_profile, 'image'=>'khôi']);
        // dd(public_path('uploads\images\candidate\\'. $seeker_profile->image));
        $path = public_path('uploads\images\candidate\\'. $seeker_profile->image);
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $image = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $pdf = Pdf::loadView('client.profile.export_pdf', ['seeker_profile' => $seeker_profile, 'image'=>$image])->setOptions(['defaultFont' => 'DejaVu Sans']);
        $name_file = $seeker_profile->name.'_profile.pdf';
        return $pdf->download($name_file);
    }
}
