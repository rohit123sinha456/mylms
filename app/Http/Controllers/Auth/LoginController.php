<?php

namespace App\Http\Controllers\Auth;

use App\Models\Teacher;
use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Crypt;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:2'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            session(['admin' => bcrypt('admin')]);
            return redirect('/admin/login');
        }
        return redirect('/admin');
    }
    public function showadminLogin(Request $request){
        $teacher = Teacher::all()->count();
        $student = User::all()->count();
        $courses = Course::all()->count();
        $lesson = Lesson::all()->count();
        return view('admin',['teacher'=>$teacher,'student'=>$student,'courses'=>$courses,'lesson'=>$lesson]);
    }
    public function studentLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:2'
        ]);

        if (Auth::guard('student')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $studentid = User::where('email',$request->email)->first();
            session(['student' => Crypt::encryptString($studentid->id),'studid'=> Crypt::encryptString($studentid->id)]);
            return redirect('/student/login');
        }
        return redirect('/student');
    }
    public function showstudentLogin(Request $request){
        $courses = Course::all()->count();
        $lesson = Lesson::all()->count();
        return view('student.admin',['courses'=>$courses,'lesson'=>$lesson]);
    }


    public function teacherLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:2'
        ]);

        if (Auth::guard('teacher')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $teacherid = Teacher::where('email',$request->email)->first();
            session(['teacher' => Crypt::encryptString($teacherid->id),'teachid'=> Crypt::encryptString($teacherid->id)]);
            return redirect('/teacher/login');
        }
        return redirect('/teacher');
    }
    public function showteacherLogin(Request $request){
        $courses = Course::all()->count();
        $lesson = Lesson::all()->count();
        return view('teachers.admin',['courses'=>$courses,'lesson'=>$lesson]);
    }
}

