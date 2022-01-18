<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Student\StudentCourseController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
Route::get('/admin', function () {
    return view('welcome');
})->name('login');

Route::get('/student', function () {
    return view('student.loginpage');
})->name('studentlogin');

Route::get('/logout',function(Request $request){
    $request->session()->flush();
    Auth::logout();
    return redirect('/');
});

Route::prefix('admin')->group(function(){
    Route::post('/login', [LoginController::class ,'adminLogin'])->name('admin_login');
    Route::get('/login', [LoginController::class ,'showadminLogin'])->middleware('is_admin');
    Route::get('/teachers',[HomeController::class,'showteachers'])->middleware('is_admin');
    Route::get('/createorupdate',[HomeController::class,'createorupdatepage'])->middleware('is_admin');
    Route::post('/createorupdate',[HomeController::class,'createorupdateform'])->middleware('is_admin');
    Route::get('/courses',[CourseController::class,'showcourses'])->middleware('is_admin');
    Route::get('/createcourses',[CourseController::class,'showcreatecourses'])->middleware('is_admin');
    Route::post('/createcourses',[CourseController::class,'createcourses'])->middleware('is_admin');
    Route::get('/viewcourse/{id}',[CourseController::class,'viewcourse'])->middleware('is_admin');
    Route::get('/editcourse/{id}',[CourseController::class,'vieweditcourse'])->middleware('is_admin');
    Route::post('/editcourse/{id}',[CourseController::class,'updateeditcourse'])->middleware('is_admin');
    Route::post('/deletecourse',[CourseController::class,'deletecourse'])->middleware('is_admin');
    Route::post('/publishcourse',[CourseController::class,'publishcourse'])->middleware('is_admin');
    Route::post('/lessons/view',[LessonController::class,'viewcourselessons'])->middleware('is_admin');
    Route::resource('/lessons',LessonController::class)->middleware('is_admin');
    Route::resource('/students',StudentController::class)->middleware('is_admin');
});

Route::prefix('teacher')->group(function(){
    Route::post('/login', [LoginController::class ,'teacherLogin'])->name('teacher_login');
});

Route::prefix('student')->group(function(){
    Route::post('/login', [LoginController::class ,'studentLogin'])->name('teacher_login');
    Route::get('/login', [LoginController::class ,'showstudentLogin'])->middleware('is_student');
    Route::get('/mycourses', [StudentCourseController::class ,'showcourses'])->middleware('is_student');
    Route::get('/courselessons/{id}', [StudentCourseController::class ,'showcourselessons'])->middleware('is_student');
    Route::get('/viewlessons/{id}', [StudentCourseController::class ,'viewlessons'])->middleware('is_student');

});
