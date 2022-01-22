<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\CourseUser;
use App\Models\CourseTeacher;
use Illuminate\Support\Facades\Schema;


use App\Http\Controllers\Controller;
class TeacherLessonController extends Controller
{
    
    public function create(Request $request)
    {
        $teacherid = Crypt::decryptString($request->session()->get('teacher'));
        $allCourses = CourseTeacher::where('teacher_id',$teacherid)->get();
        return view('teachers.createlesson',['course'=>$allCourses]);
    }

    
    public function store(Request $request)
    {
        $lesson = new Lesson;
        $lesson->title = $request->title;
        $lesson->content = $request->content;
        $lesson->course_id = $request->courseid;
        $lesson->video = $request->video;
        $lesson->material = $request->material;
        $lesson->save();
        $lessonid = $lesson->id;
        return redirect('/teacher/lessons/'.$lessonid);
    }

   
    public function show($id)
    {
        $lessonid = $id;//$request->query('courseid');
        $lessondetails = Lesson::find($lessonid);
        $coloumns = Schema::getColumnListing('lessons');
        return view('teachers.viewlesson',['item'=>$lessondetails,'column'=>$coloumns]);
        
    }

    
    public function edit($id)
    {
        $lessondetails = Lesson::find($id);
        return view('teachers.editlesson',['item'=>$lessondetails]);
    }

    
    public function update(Request $request, $id)
    {
        $lessondetails = Lesson::find($id);
        $lessondetails->title = $request->title;
        $lessondetails->content = $request->content;
        $lessondetails->video = $request->video;
        $lessondetails->material = $request->material;
        $lessondetails->save();
        return redirect('/teacher/lessons/'.$id);
    }

    
    public function destroy($id)
    {
        $course = Lesson::destroy($id);
        return redirect('/teacher/lessons/');
    }

    public function publish($id)
    {
        $status_enum = ['enabled','disabled']; //change it to something dynamic, where it will take the value frm the enum class
        $lessondetails = Lesson::find($id);
        $new_status = array_values(array_diff($status_enum,[$lessondetails->status]));
        $lessondetails->status = $new_status[0];
        $lessondetails->save();
        return redirect('/teacher/lessons/'.$id);
    }
}
