<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Support\Facades\Schema;


use App\Http\Controllers\Controller;
class LessonController extends Controller
{
   
    public function index()
    {
        $allcourses = Course::all();
        return view('admindashboard.selectlessoncourse',['courses'=>$allcourses]);
    }

    
    public function create()
    {
        $allCourses = Course::all();
        return view('admindashboard.createlesson',['course'=>$allCourses]);
    }

    
    public function store(Request $request)
    {
        $lesson = new Lesson;
        $lesson->title = $request->title;
        $lesson->content = $request->content;
        $lesson->course_id = $request->courseid;
        $lesson->save();
        $lessonid = $lesson->id;
        return redirect('/admin/lessons/'.$lessonid);
    }

   
    public function show($id)
    {
        $lessonid = $id;//$request->query('courseid');
        $lessondetails = Lesson::find($lessonid);
        $coloumns = Schema::getColumnListing('lessons');
        return view('admindashboard.viewlesson',['item'=>$lessondetails,'column'=>$coloumns]);
        
    }

    
    public function edit($id)
    {
        $lessondetails = Lesson::find($id);
        return view('admindashboard.editlesson',['item'=>$lessondetails]);
    }

    
    public function update(Request $request, $id)
    {
        $lessondetails = Lesson::find($id);
        $lessondetails->title = $request->title;
        $lessondetails->content = $request->content;
        $lessondetails->save();
        return redirect('/admin/lessons/'.$id);
    }

    
    public function destroy($id)
    {
        $course = Lesson::destroy($id);
        return redirect('/admin/lessons/'.$id);
    }

    public function publish($id)
    {
        $status_enum = ['enabled','disabled']; //change it to something dynamic, where it will take the value frm the enum class
        $lessondetails = Lesson::find($id);
        $new_status = array_values(array_diff($status_enum,[$lessondetails->status]));
        $lessondetails->status = $new_status[0];
        $lessondetails->save();
        return redirect('/admin/lessons/');
    }
    public function viewcourselessons(Request $request){
        // use some table or stuff/ try to deal with tables and searchable stuff
        $courseid = $request->query('courseid');
        $courselessons = Lesson::where('course_id',$courseid)->get();
        return view('admindashboard.showlessoncourse',['courses'=>$courselessons]);
    }
}
