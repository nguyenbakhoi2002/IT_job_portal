<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Company\DashboardController;
use App\Http\Controllers\Company\JobPostController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Company\ProfileApplyController;

use App\Http\Controllers\Company\LoginController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
//Post
Route::resource('/post', JobPostController::class);
// Route::prefix('post')->group(function () {
    Route::get('/profile-apply/{id}', [JobPostController::class, 'profileApply'])->name('profileApply');
// });
//thông tin công ty
Route::get('/info', [CompanyController::class, 'info'])->name('info');
Route::post('/info-update', [CompanyController::class, 'infoUpdate'])->name('infoUpdate');
    //giấy phép kinh doanh
    Route::get('/image-paper', [CompanyController::class, 'imagePaper'])->name('imagePaper');
    Route::post('/image-paper-update', [CompanyController::class, 'imagePaperUpdate'])->name('imagePaperUpdate');


