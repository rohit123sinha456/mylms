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
    public function create(Request $request)
    {
        //$newtest = new Test;
        
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
       $questions = Questions::where('test_id',$id)->get();
       return view ('teachers.showquestions',['questions'=>$questions,'testid'=>$id]);
        
    }
    
    public function destroy($id)
    {
        
    }
}
