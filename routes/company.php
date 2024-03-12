<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Company\DashboardController;
use App\Http\Controllers\Company\JobPostController;

use App\Http\Controllers\Company\LoginController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
//Post
    Route::resource('post', JobPostController::class);