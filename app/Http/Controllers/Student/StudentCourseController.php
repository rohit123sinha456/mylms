<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\CourseUser;
use App\Actions\TopicAction;
use App\Actions\Reply;
use App\Actions\Discussion;
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
    public function viewlessons(Request $request,$id)
    {
        $lessonid = $id;//$request->query('courseid');
        $lessondetails = Lesson::find($lessonid);
        $coloumns = Schema::getColumnListing('lessons');
        return view('student.viewlesson',['item'=>$lessondetails,'column'=>$coloumns]);
        
    }

    public function showtopics($id)
    {
        $topics = TopicAction::getTopic($id);
        return view('student.showtopics',['topics'=>$topics]);
    }

    public function showlessonvideo($id){
        $videolink = Lesson::find($id);
        return view('student.lessonvideo',['item'=>$videolink,'link'=>$videolink->video]);
    }
    public function showlessonmaterial($id){
        $videolink = Lesson::find($id);
        return view('student.lessonmaterial',['item'=>$videolink,'link'=>$videolink->material]);
    }
}
