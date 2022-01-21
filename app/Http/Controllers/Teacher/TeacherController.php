<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\CourseUser;
use App\Models\CourseTeacher;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Foundation\Auth\AuthenticatesUsers;



use App\Http\Controllers\Controller;
class TeacherController extends Controller
{
    use AuthenticatesUsers;

    public function showcourses(Request $request){
        $teacherid = Crypt::decryptString($request->session()->get('teacher'));
        $mycourses = CourseTeacher::where('teacher_id',$teacherid)->get();
        return view('teachers.showcourses',['mycourses'=>$mycourses]);
    }
    public function showcourselesson(Request $request,$id)
    {
        //check if teacher has permission to view this course
        $courseid = $id;
        $coursename = Course::find($courseid)->name;
        $courselessons = Lesson::where('course_id',$courseid)->get();
        return view('teachers.showlessons',['lessons'=>$courselessons,'coursename'=>$coursename]);
    }
}
