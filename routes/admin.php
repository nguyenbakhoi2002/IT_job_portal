<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\MajorController;
use App\Http\Controllers\Admin\DegreeController;
use App\Http\Controllers\Admin\TimeController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\CandidateController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

//company-công ty
    Route::resource('company', CompanyController::class); 
    //thùng rác
    Route::get('/company-trash',[CompanyController::class, 'trash'] )->name('company.trash');
    Route::get('/company-trash/{id}',[CompanyController::class, 'restore'] )->name('company.restore');
    Route::get('/company-forceDelete/{id}',[CompanyController::class, 'force'] )->name('company.forceDelete');
    //status
    Route::post('company-status/{id}', [CompanyController::class, 'status'])->name('company.status');
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
//major-Chuyên ngành
    Route::resource('major', MajorController::class); 
    Route::get('/major-trash',[MajorController::class, 'trash'] )->name('major.trash');
    Route::get('/major-trash/{id}',[MajorController::class, 'restore'] )->name('major.restore');
    Route::get('/major-forceDelete/{id}',[MajorController::class, 'force'] )->name('major.forceDelete');
//degree- bằng cấp
    Route::resource('degree', DegreeController::class); 
    Route::post('degree-status/{id}', [DegreeController::class, 'status'])->name('degree.status');
    Route::get('degree-trash',[DegreeController::class, 'trash'] )->name('degree.trash');
    Route::get('degree-trash/{id}', [DegreeController::class, 'restore'])->name('degree.restore');
    Route::get('/degree-forceDelete/{id}',[DegreeController::class, 'force'] )->name('degree.forceDelete');
//degree- số năm kinh nghiệm
Route::resource('time', TimeController::class); 
    Route::post('time-status/{id}', [TimeController::class, 'status'])->name('time.status');
    Route::get('time-trash',[TimeController::class, 'trash'] )->name('time.trash');
    Route::get('time-trash/{id}', [TimeController::class, 'restore'])->name('time.restore');
    Route::get('/time-forceDelete/{id}',[TimeController::class, 'force'] )->name('time.forceDelete');

?>
