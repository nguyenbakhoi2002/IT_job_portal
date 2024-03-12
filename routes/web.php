<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Company\LoginController;



//candidate
Route::get('/', [HomeController::class, 'index'])->name('index');

//company
Route::prefix('company')->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('company.login');
    Route::post('/login', [LoginController::class, 'postLogin']);
    Route::get('/logout',[LoginController::class, 'logout'])->name('logout'); 


});


