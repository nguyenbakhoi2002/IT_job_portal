<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Company\DashboardController;
use App\Http\Controllers\Company\JobPostController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Company\ProfileApplyController;

use App\Http\Controllers\Company\LoginController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/company-change-password', [CompanyController::class, 'changePassword'])->name('changePassword');
Route::post('/company-update-password', [CompanyController::class, 'updatePassword'])->name('updatePassword');

//Post
Route::resource('/post', JobPostController::class);
// Route::get('/post-activing', [JobPostController::class, 'activing'])->name('postActiving');
//bài đnăg đã tạo chưa duyệt
Route::get('/post-created',  [JobPostController::class, 'postCreated'])->name('postCreated'); 
//bài đăng hết hạn
Route::get('/post-expired',  [JobPostController::class, 'postExpired'])->name('postExpired');
//đăng bài - thay đổi status
Route::post('post-created-status/{id}', [JobPostController::class, 'status'])->name('postPost');

//profile tất cả
Route::get('/profile-all',  [ProfileApplyController::class, 'profileAll'])->name('profileAll'); 
//trang tìm kiếm ứng viên
Route::get('profile-filter',[ProfileApplyController::class, 'profileFilter'])->name('profileFilter');;

//status của profile (trang tất cả profille)
Route::post('/profile-status/{id}', [ProfileApplyController::class, 'statusAll'])->name('updateStatusAll');
// profile cho từng bài đăng
Route::get('/profile-apply/{id}', [JobPostController::class, 'profileApply'])->name('profileApply');
//export excel profile cho từng bài đăng
Route::get('/export-profile-apply/{id}', [JobPostController::class, 'exportProfileApply'])->name('exportProfileApply');

//status của profile (trang profille của từng bài đăng)
// Route::post('/profile-apply-status/{id}', [ProfileApplyController::class, 'statusOwn'])->name('updateStatusOwn');
// });
//thông tin công ty
Route::get('/info', [CompanyController::class, 'info'])->name('info');
Route::post('/info-update', [CompanyController::class, 'infoUpdate'])->name('infoUpdate');
    //giấy phép kinh doanh
    Route::get('/image-paper', [CompanyController::class, 'imagePaper'])->name('imagePaper');
    Route::post('/image-paper-update', [CompanyController::class, 'imagePaperUpdate'])->name('imagePaperUpdate');


