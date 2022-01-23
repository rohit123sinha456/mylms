<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\Course;
use App\Models\Test;
use App\Models\Questions;
use App\Models\Answers;

use App\Models\CourseTeacher;
use Illuminate\Support\Facades\Schema;

use App\Http\Controllers\Controller;
class TeacherTestController extends Controller
{
    public function showcoursestest(Request $request){
        $teacherid = Crypt::decryptString($request->session()->get('teacher'));
        $mycourses = CourseTeacher::where('teacher_id',$teacherid)->get();
        
        return view('teachers.showcoursestest',['mycourses'=>$mycourses]);
    }
    public function index(Request $request){
        $courseid =  $request->query('courseid');
        $coursename = Course::find($courseid);
        $tests = Test::where('course_id',$courseid)->get();
        return view('teachers.showtestsforcourse',['tests'=>$tests,'coursename'=>$coursename->name,'courseid'=>$courseid]);
    }
    public function store(Request $request)
    {
        $newtest = new Test;
        $newtest->name = $request->name;
        $newtest->course_id = $request->courseid;
        $newtest->save();
        return redirect('/teacher/coursetests');
        
    }
    public function show($id)
    {
        $details = array();
       $questions = Questions::where('test_id',$id)->get();
       
       foreach($questions as $question){
           $answers = Answers::where('question_id',$question->id)->get();
           $details[] = $details + array('id'=>$question->id,'question'=>$question->question,'answer'=>$answers);
       }
       
       //dd($details);
       return view ('teachers.showquestions',['questions'=>$details,'testid'=>$id]);
       
    }
    
    public function destroy(Request $request, $id)
    {
        $test = Test::destroy($id);
        $courseid = $request->courseid;
        return redirect('/teacher/createquestion');
    }
}
