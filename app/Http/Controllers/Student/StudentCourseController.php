<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\CourseUser;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


use App\Http\Controllers\Controller;
class StudentCourseController extends Controller
{
    use AuthenticatesUsers;
    public function showcourses(Request $request)
    {
        $studentid = Crypt::decryptString($request->session()->get('student'));
        $mycourses = CourseUser::where('user_id',$studentid)->get();
        return view('student.showcourses',['mycourses'=>$mycourses]);
    }
    public function showcourselessons(Request $request,$id)
    {
        $lessons =  Lesson::select("*")
        ->where([
            ["status", "=", "enabled"],
            ["course_id", "=", $id]
        ])
        ->get();
        return view('student.showlessons',['lessons'=>$lessons]);
    }
    public function viewlessons($id)
    {
        $lessonid = $id;//$request->query('courseid');
        $lessondetails = Lesson::find($lessonid);
        $coloumns = Schema::getColumnListing('lessons');
        return view('student.viewlesson',['item'=>$lessondetails,'column'=>$coloumns]);
        
    }
}
