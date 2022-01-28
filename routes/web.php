<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Student\StudentCourseController;
use App\Http\Controllers\Student\StudentTestController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Teacher\TeacherLessonController;
use App\Http\Controllers\Teacher\TeacherTestController;
use App\Http\Controllers\Teacher\TeacherQuestionController;


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
Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/admin', function () {
    return view('welcome');
})->name('login');

Route::get('/student', function () {
    return view('student.loginpage');
})->name('studentlogin');

Route::get('/teacher', function () {
    return view('teachers.loginpage');
})->name('teacherlogin');


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
    Route::post('/login', [LoginController::class ,'studentLogin'])->name('student_login');
    Route::get('/login', [LoginController::class ,'showstudentLogin'])->middleware('is_student');
    Route::get('/settings', [LoginController::class ,'showstudentSettings'])->middleware('is_student');
    Route::get('/passwordreset', [LoginController::class ,'showstudentPasswordReset'])->middleware('is_student');
    Route::post('/passwordreset', [LoginController::class ,'studentPasswordReset'])->middleware('is_student');
    Route::get('/mycourses', [StudentCourseController::class ,'showcourses'])->middleware('is_student');
    Route::get('/courselessons/{id}', [StudentCourseController::class ,'showcourselessons'])->middleware('is_student');
    Route::get('/viewlessons/{id}', [StudentCourseController::class ,'viewlessons'])->middleware('is_student');
    //Route::get('/showtopics/{id}', [StudentCourseController::class ,'showtopics'])->middleware('is_student');
    Route::get('/showlessonvideo/{id}', [StudentCourseController::class ,'showlessonvideo'])->middleware('is_student');
    Route::get('/showlessonmaterial/{id}', [StudentCourseController::class ,'showlessonmaterial'])->middleware('is_student');
    Route::get('/coursetest', [StudentTestController::class ,'showcoursetest'])->middleware('is_student');
    Route::get('/coursetest/{id}', [StudentTestController::class ,'showtests'])->middleware('is_student');
    Route::get('/test/{id}', [StudentTestController::class ,'showquestions'])->middleware('is_student');
    Route::post('/test/submit/{id}', [StudentTestController::class ,'submittest'])->middleware('is_student');

});//showtopics

Route::prefix('teacher')->group(function(){
    Route::post('/login', [LoginController::class ,'teacherLogin'])->name('teacher_login');
    Route::get('/login', [LoginController::class ,'showteacherLogin'])->middleware('is_teacher');
    Route::get('/courses', [TeacherController::class ,'showcourses'])->middleware('is_teacher');
    Route::get('/courselessons/{id}', [TeacherController::class ,'showcourselesson'])->middleware('is_teacher');
    Route::resource('/lessons',TeacherLessonController::class)->middleware('is_teacher');
    Route::get('/coursetests',[TeacherTestController::class,'showcoursestest'])->middleware('is_teacher');
    Route::post('/alltest',[TeacherTestController::class,'index'])->middleware('is_teacher');
    Route::resource('/test',TeacherTestController::class,['except' => ['index','edit','update','publish','create']])->middleware('is_teacher');
    Route::post('/test/createquestion',[TeacherQuestionController::class,'store'])->middleware('is_teacher');
    Route::post('/test/deletequestion/{id}',[TeacherQuestionController::class,'destroy'])->middleware('is_teacher');

});
Route::get('/test',function(){
    return view('teachers.test');
});