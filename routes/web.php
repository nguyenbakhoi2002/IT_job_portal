<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\CompanyController;
use App\Http\Controllers\Client\JobPostController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Client\JobPostActivitiesController;
use App\Http\Controllers\Client\SavedJobController;
use App\Http\Controllers\Client\SavedCompanyController;
use App\Http\Controllers\Client\CandidateController;
use App\Http\Controllers\Company\LoginController;
use App\Http\Controllers\Admin\AdminController;




Route::get('/choose-login', [HomeController::class, 'choose'])->name('choose');
//candidate
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/login', [ClientController::class, 'login'])->name('login');
Route::post('/login', [ClientController::class, 'postLogin']);
Route::get('/register', [ClientController::class, 'register'])->name('register');
Route::post('/register', [ClientController::class, 'postRegister']);
Route::get('/logout', [ClientController::class, 'logout'])->name('logout');
    //candidate-company
    Route::get('/company-list', [CompanyController::class, 'index'])->name('company-list');
    Route::get('/company-detail/{company}', [CompanyController::class, 'detail'])->name('company-detail');
    //candidate-job
    Route::get('/job-list', [JobPostController::class, 'index'])->name('job-list');
    Route::get('/job-detail/{job}', [JobPostController::class, 'detail'])->name('job-detail');


//company
Route::prefix('company')->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('company.login');
    Route::post('/login', [LoginController::class, 'postLogin']);
    Route::get('/logout',[LoginController::class, 'logout'])->name('logout'); 
    Route::get('/register', [LoginController::class, 'register'])->name('company.register');
    Route::post('/register', [LoginController::class, 'postRegister']);

});
//admin
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'postLogin']);
    Route::get('/logout',[AdminController::class, 'logout'])->name('logout'); 


});
//profile
Route::post('/create-cv', [ProfileController::class, 'createProfile'])->name('createProfile')->middleware('auth.candidate');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile')->middleware('auth.candidate');
Route::get('/profile-preview/{seeker_profile}', [ProfileController::class, 'profilePreview'])->name('profilePreview');
Route::get('/export-profile/{seeker_profile}', [ProfileController::class, 'exportProfile'])->name('exportProfile');

Route::prefix('update-cv')->middleware('auth.candidate')->group(function () {
    //thông tin cơ bản
    Route::post('/update-info', [ProfileController::class, 'updateInfo'])->name('updateCv.updateInfo');
    //kinh nghiệm làm việc
    Route::post('/create-experience', [ProfileController::class, 'createExperience'])->name('updateCv.createExperience');
    Route::post('/update-experience/{id}', [ProfileController::class, 'updateExperience'])->name('updateCv.updateExperience');
    Route::get('/delete-experience/{id}', [ProfileController::class, 'deleteExperience'])->name('updateCv.deleteExperience');
    //các dự án đã làm
    Route::post('/create-project', [ProfileController::class, 'createProject'])->name('updateCv.createProject');
    Route::post('/update-project/{id}', [ProfileController::class, 'updateProject'])->name('updateCv.updateProject');
    Route::get('/delete-project/{id}', [ProfileController::class, 'deleteProject'])->name('updateCv.deleteProject');
    //học vấn
    Route::post('/create-education', [ProfileController::class, 'createEducation'])->name('updateCv.createEducation');
    Route::post('/update-education/{id}', [ProfileController::class, 'updateEducation'])->name('updateCv.updateEducation');
    Route::get('/delete-education/{id}', [ProfileController::class, 'deleteEducation'])->name('updateCv.deleteEducation');
    //skill
    Route::post('/save-skills', [ProfileController::class, 'saveSkills'])->name('updateCv.saveSkills');
    Route::get('/delete-all-skill/{seeker_profile_id}', [ProfileController::class, 'DeleteAllSkill'])->name('updateCv.DeleteAllSkill');
    //ngoại ngữ (language)
    Route::post('/create-language', [ProfileController::class, 'createLanguage'])->name('updateCv.createLanguage');
    Route::post('/update-language/{id}', [ProfileController::class, 'updateLanguage'])->name('updateCv.updateLanguage');
    Route::get('/delete-language/{id}', [ProfileController::class, 'deleteLanguage'])->name('updateCv.deleteLanguage');
});

//ứng tuyển
Route::get('/applied/{id}', [JobPostActivitiesController::class, 'applied'])->name('applied')->middleware('auth.candidate');
//hủy ứng tuyển
Route::get('/cancel-applied/{id}', [JobPostActivitiesController::class, 'cancelApplication'])->name('cancelApplied')->middleware('auth.candidate');
//danh sách các công việc đã ứng tuyển
Route::get('/job-applied', [JobPostActivitiesController::class, 'jobApplied'])->name('jobApplied')->middleware('auth.candidate');


//lưu công việc
Route::get('/save-job/{id}', [SavedJobController::class, 'saveJob'])->name('saveJob')->middleware('auth.candidate');
Route::get('/cancel-save-job/{id}', [SavedJobController::class, 'cancelSaveJob'])->name('cancelSaveJob')->middleware('auth.candidate');
//danh sách các công việc đã lưu
Route::get('/job-saved', [SavedJobController::class, 'jobSaved'])->name('jobSaved')->middleware('auth.candidate');
//lưu company
Route::get('/save-company/{id}', [SavedCompanyController::class, 'saveCompany'])->name('saveCompany')->middleware('auth.candidate');
Route::get('/cancel-save-company/{id}', [SavedCompanyController::class, 'cancelSaveCompany'])->name('cancelSaveCompany')->middleware('auth.candidate');
//danh sách các công ty đã lưu
Route::get('/company-saved', [SavedCompanyController::class, 'companySaved'])->name('companySaved')->middleware('auth.candidate');
//thông tin cá nhân ứng viên
Route::get('/candidate-detail', [CandidateController::class, 'detail'])->name('detail')->middleware('auth.candidate');
Route::post('/candidate-update-detail', [CandidateController::class, 'updateDetail'])->name('updateDetail')->middleware('auth.candidate');
//đổi mật khẩu
Route::get('/change-password', [CandidateController::class, 'changePassword'])->name('changePassword')->middleware('auth.candidate');
Route::post('/candidate-update-password', [CandidateController::class, 'updatePassword'])->name('updatePassword')->middleware('auth.candidate');


