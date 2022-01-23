<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\CourseUser;
use App\Models\Test;
use App\Models\Questions;
use App\Models\Answers;
use App\Models\StudentAnswers;
use App\Actions\StudentResult;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


use App\Http\Controllers\Controller;
class StudentTestController extends Controller
{
    public function showcoursetest(Request $request){
        $studentid = Crypt::decryptString($request->session()->get('student'));
        $mycourses = CourseUser::where('user_id',$studentid)->get();
        return view('student.showcoursetest',['mycourses'=>$mycourses]);
    }
    public function showtests(Request $request,$id){
        $courseid =  $id;
        $studentid = Crypt::decryptString($request->session()->get('student'));
        $coursename = Course::find($courseid);
        $tests = Test::where('course_id',$courseid)->get();
        $result = StudentResult::getResult($tests,$studentid);
        return view('student.showtests',['tests'=>$tests,'coursename'=>$coursename->name,'courseid'=>$courseid,'result'=>$result]);
    
    }
    public function showquestions($id){
        $details = array();
       $questions = Questions::where('test_id',$id)->get();
       
       foreach($questions as $question){
           $answers = Answers::where('question_id',$question->id)->get();
           $details[] = $details + array('id'=>$question->id,'question'=>$question->question,'answer'=>$answers,'testid'=>$id);
       }
       
       //dd($details);
       return view ('student.showquestions',['questions'=>$details,'testid'=>$id]);
    }
    public function submittest(Request $request,$id){
        $studentid = Crypt::decryptString($request->session()->get('student'));
        $testid = $request->testid;
        foreach($request->all() as $tid=>$aid)
        {
            if( is_numeric($tid) ){
                $studentanswers = new StudentAnswers;
                $studentanswers->test_id = $testid;
                $studentanswers->question_id = (int)$tid;
                $studentanswers->answer_id = (int)$aid;
                $studentanswers->student_id = $studentid;
                $studentanswers->save();
            }
        }
        return redirect('/student/coursetest');
    }
}
