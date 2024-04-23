<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\SeekerProfile;
use App\Models\JobPost;
use App\Models\Education;
use App\Models\Project;
use App\Models\Experience;
use App\Models\skill;
use App\Models\Language;
use App\Models\SeekerLanguage;
use App\Models\JobPostLanguage;
use App\Models\JobPostActivity;

use DB;
use Illuminate\Http\Request;

class JobPostActivitiesController extends Controller
{
    public function applied(Request $request, string $id){
        DB::beginTransaction();
        try {
            //mảng chứa các tiêu chí tuyển dụng mà ứng viên thỏa mãn
            //lưu là edu|exp|skill|language cách nhau bởi dấu |
            $satisfy = [];
            //lấy ra bài đăng đang được ứng tuyển
            $post =  JobPost::find($id);
            //lấy ra các yêu cầu 
            //level của bằng cấp;
            $required_degree = $post->degree->level;
            if($required_degree==0)  $satisfy[]='edu';
            //level của experience
            $required_exp = $post->experience->level;
            if($required_exp==0)  $satisfy[]='exp';
            //mảng kĩ năng
            $required_skill = $post->skills->pluck('id')->toArray();
            //mảng ngoại ngữ
            $required_language = JobPostLanguage::where('job_post_id', $id)->get();



            //lấy ra người dùng hiện tại
            $client = auth('candidate')->user();
            // Nhân bản profile hiện tại của ứng viên
            $currentProfile = $client->seekerProfile()->where('is_clone', 0)->first();
            $clonedProfile = $currentProfile->replicate();
            $clonedProfile->is_clone = 1;
            $clonedProfile->save();

            //học vấn
            if($currentProfile->educations){
                // Nhân bản bản ghi trong bảng education tham chiếu tới profile hiện tại
                foreach ($currentProfile->educations as $currentEducation) {
                    $clonedEducation = $currentEducation->replicate();
                    $clonedEducation->seeker_profile_id = $clonedProfile->id; // Liên kết với profile mới
                    $clonedEducation->save();
                    //so sánh bằng cấp bản clone với yêu cầu trong post 
                    if((!in_array('edu', $satisfy))&&($clonedEducation->degree->level>=$required_degree)){
                        $satisfy[]='edu';
                    }
                }
                
            }
            //kinh nghiệm
            if($currentProfile->experiences){
                foreach ($currentProfile->experiences as $currentExp) {
                    $clonedExp = $currentExp->replicate();
                    $clonedExp->seeker_profile_id = $clonedProfile->id; // Liên kết với profile mới
                    $clonedExp->save();
                }
                
            }
            //so sánh kinh nghiệm 
            if((!in_array('exp', $satisfy))&&($clonedProfile->total_experience>=$required_exp)){
                $satisfy[]='exp';
                
            }
            //kĩ năng
            $seekerSkillClone=[];
            if($currentProfile->skills){
                foreach ($currentProfile->skills as $skill) {
                    //thêm vào bảng trung gian
                    $clonedProfile->skills()->attach($skill->id);
                }
                $seekerSkillClone=$clonedProfile->skills->pluck('id')->toArray();
            }
            //so sánh kĩ năng
            //trả về tru nếu tất cả kĩ năng trong bài tuyển nằm trong kĩ nằm của ứng viên
            if(empty(array_diff($required_skill, $seekerSkillClone))){
                $satisfy[]='skill';
            }

            //ngoại ngữ
            if($currentProfile->languages){
                //lấy ra tất cả bản ngôn ngữ có trong profile
                $seekerLanguages = SeekerLanguage::where('seeker_profile_id', $currentProfile->id)->get();
                foreach ($seekerLanguages as $seekerLanguage) {
                    // Tạo bản sao của SeekerLanguage
                    $clonedSeekerLanguage = $seekerLanguage->replicate();
                    $clonedSeekerLanguage->seeker_profile_id = $clonedProfile->id; // Gán id của bản sao của SeekerProfile mới
                    $clonedSeekerLanguage->save();
                }
            }
            //so sánh ngoại ngữ
                $check_language=true;
                //lấy ra tất cả yêu cầu ngôn ngữ của bài đăng 
                $jobPostLanguages = JobPostLanguage::where('job_post_id', $id)->get();
                //nếu ko có yêu cầu ngôn ngữ trả về true luôn không cần so sánh
                if($jobPostLanguages->count()==0) $check_language=true;
                else{
                    //tất cả ngôn ngữ có trong profile clone
                    $seekerCloneLanguages = SeekerLanguage::where('seeker_profile_id', $clonedProfile->id)->get();
                    //nếu không có ngoại ngữ trả về false luôn, không cần so sánh
                    if($seekerCloneLanguages->count()==0) $check_language=false;
                    foreach ($jobPostLanguages as $jobPostLanguage) {
                        // Tìm mức độ ngôn ngữ của ứng viên tương ứng với ngôn ngữ yêu cầu
                        $seekerCloneLanguage = $seekerCloneLanguages->where('language_id', $jobPostLanguage->language_id)->first();
                    
                        // Kiểm tra xem mức độ ngôn ngữ của ứng viên có đáp ứng được yêu cầu không
                        if ($seekerCloneLanguage && $seekerCloneLanguage->level >= $jobPostLanguage->level) {
                            // Nếu đáp ứng được, tiếp tục kiểm tra các yêu cầu khác
                            continue;
                        } else {
                            // Nếu không đáp ứng được, trả về false hoặc thực hiện hành động phù hợp
                            $check_language=false;
                            break;
                        }
                    }   
                }
                
                if ($check_language){
                    $satisfy[]='language';
                }
            //project
            if($currentProfile->projects){
                foreach ($currentProfile->projects as $currentProject) {
                    $clonedProject = $currentProject->replicate();
                    $clonedProject->seeker_profile_id = $clonedProfile->id; // Liên kết với profile mới
                    $clonedProject->save();
                }
            }
            
            $jobPostActivities = new JobPostActivity();
            $jobPostActivities->seeker_profile_id = $clonedProfile->id;
            $jobPostActivities->job_post_id = $id;
            $jobPostActivities->satisfy = implode('|', $satisfy); // Chuyển mảng $satisfy thành chuỗi ngăn cách bởi dấu '|'
            $jobPostActivities->save();


            

            // Hoàn thành giao dịch
            DB::commit();
            return redirect()->back()->with('success', 'thêm mới thành công');
            // return response()->json([
            //     'success' => 'Ứng tuyển thành công!',
            // ]);
        } catch (\Exception $e) {
            // Nếu có lỗi, rollback giao dịch và trả về thông báo lỗi
            DB::rollBack();
            return redirect()->back()->with('error', 'thêm mới thất bại'.$e->getMessage());
            // return response()->json([
            //     'error' => 'Ứng tuyển thất bại: ' . $e->getMessage(),
            // ]);
        }
    }
}
