<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Company\LoginController;



//candidate
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/login', [ClientController::class, 'login'])->name('login');
Route::post('/login', [ClientController::class, 'postLogin']);
Route::get('/register', [ClientController::class, 'register'])->name('register');
Route::post('/register', [ClientController::class, 'postRegister']);
Route::get('/logout', [ClientController::class, 'logout'])->name('logout');



//company
Route::prefix('company')->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('company.login');
    Route::post('/login', [LoginController::class, 'postLogin']);
    Route::get('/logout',[LoginController::class, 'logout'])->name('logout'); 


});


