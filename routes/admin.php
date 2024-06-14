<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\MajorController;
use App\Http\Controllers\Admin\DegreeController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\TimeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\JobPostController;
use App\Http\Controllers\Admin\CandidateController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
//biểu đồ
Route::post('api-company', [DashboardController::class, 'chartCompany']);
Route::post('api-candidate', [DashboardController::class, 'chartCandidate']);
Route::post('api-post', [DashboardController::class, 'chartPost']);

//company-công ty
    Route::resource('company', CompanyController::class); 
    //thùng rác
    Route::get('/company-trash',[CompanyController::class, 'trash'] )->name('company.trash');
    Route::get('/company-trash/{id}',[CompanyController::class, 'restore'] )->name('company.restore');
    Route::get('/company-forceDelete/{id}',[CompanyController::class, 'force'] )->name('company.forceDelete');
    //status
    Route::post('company-status/{id}', [CompanyController::class, 'status'])->name('company.status');
//company bị chặn
    Route::get('/company-waiting',[CompanyController::class, 'companyWaiting'] )->name('company.companyWaiting');
//chấp nhận bài đăng
    Route::post('/company-accept/{id}',[CompanyController::class, 'companyAccept'] )->name('company.accept');
//bài đăng - jobpost
Route::resource('post', JobPostController::class);  

//số bài đăng chờ duyệt
Route::get('/job-post-waiting',[JobPostController::class, 'jobPostWaiting'] )->name('post.jobPostWaiting');
//chấp nhận bài đăng
Route::post('/job-accept/{id}',[JobPostController::class, 'jobAccept'] )->name('post.accept');
//từ chối bài đăng
Route::post('/job-refuse',[JobPostController::class, 'jobRefuse'] )->name('post.refuse');

//candidate-ứng viên
    Route::resource('candidate', CandidateController::class); 
    //thùng rác
    Route::get('/candidate-trash',[CandidateController::class, 'trash'] )->name('candidate.trash');
    Route::get('/candidate-trash/{id}',[CandidateController::class, 'restore'] )->name('candidate.restore');
    Route::get('/candidate-forceDelete/{id}',[CandidateController::class, 'force'] )->name('candidate.forceDelete');
    //status
    Route::post('candidate-status/{id}', [CandidateController::class, 'status'])->name('candidate.status');

//kĩ năng - skill
    Route::resource('skill', SkillController::class); 
    Route::get('/skill-trash',[SkillController::class, 'trash'] )->name('skill.trash');
    Route::get('/skill-trash/{id}',[SkillController::class, 'restore'] )->name('skill.restore');
    Route::get('/skill-forceDelete/{id}',[SkillController::class, 'force'] )->name('skill.forceDelete');
    Route::post('skill-status/{id}', [SkillController::class, 'status'])->name('skill.status');

//major-Chuyên ngành
    Route::resource('major', MajorController::class); 
    Route::get('/major-trash',[MajorController::class, 'trash'] )->name('major.trash');
    Route::get('/major-trash/{id}',[MajorController::class, 'restore'] )->name('major.restore');
    Route::get('/major-forceDelete/{id}',[MajorController::class, 'force'] )->name('major.forceDelete');
    Route::post('major-status/{id}', [MajorController::class, 'status'])->name('major.status');

//degree- bằng cấp
    Route::resource('degree', DegreeController::class); 
    Route::post('degree-status/{id}', [DegreeController::class, 'status'])->name('degree.status');
    Route::get('degree-trash',[DegreeController::class, 'trash'] )->name('degree.trash');
    Route::get('degree-trash/{id}', [DegreeController::class, 'restore'])->name('degree.restore');
    Route::get('/degree-forceDelete/{id}',[DegreeController::class, 'force'] )->name('degree.forceDelete');
//time_exp- số năm kinh nghiệm
Route::resource('time', TimeController::class); 
    Route::post('time-status/{id}', [TimeController::class, 'status'])->name('time.status');
    Route::get('time-trash',[TimeController::class, 'trash'] )->name('time.trash');
    Route::get('time-trash/{id}', [TimeController::class, 'restore'])->name('time.restore');
    Route::get('/time-forceDelete/{id}',[TimeController::class, 'force'] )->name('time.forceDelete');

//language- ngoại ngữ
Route::resource('language', LanguageController::class); 
    Route::post('language-status/{id}', [LanguageController::class, 'status'])->name('language.status');
    Route::get('language-trash',[LanguageController::class, 'trash'] )->name('language.trash');
    Route::get('language-trash/{id}', [LanguageController::class, 'restore'])->name('language.restore');
    Route::get('/language-forceDelete/{id}',[LanguageController::class, 'force'] )->name('language.forceDelete');
//admin-Quản trị viên
Route::resource('admin', AdminController::class)->middleware(['checkAdminType']); 
    Route::get('/admin-trash',[AdminController::class, 'trash'] )->name('admin.trash');
    Route::get('/admin-trash/{id}',[AdminController::class, 'restore'] )->name('admin.restore');
    Route::get('/admin-forceDelete/{id}',[AdminController::class, 'force'] )->name('admin.forceDelete');
//thông tin tài khoản
Route::get('/admin-detail', [AdminController::class, 'detail'])->name('detail');
Route::post('/admin-update-detail', [AdminController::class, 'updateDetail'])->name('updateDetail');
//đổi mật khẩu
Route::get('/change-password', [AdminController::class, 'changePassword'])->name('changePassword');
Route::post('/candidate-update-password', [AdminController::class, 'updatePassword'])->name('updatePassword');


?>
