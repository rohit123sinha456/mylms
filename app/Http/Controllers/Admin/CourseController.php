<?php

namespace App\Http\Controllers\Admin;

use App\Models\Teacher;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function showcourses(Request $request)
    {
        $courses = Course::all();
        $coursedesc = array();
        foreach($courses as $course){
            $course_teacher = Teacher::find($course->teacher_id);
            $coursedesc[] = array('id'=>$course->id,'name'=>$course->name,'description'=>$course->description,'teacher'=>$course_teacher->name,'status'=>$course->status);
        }
        return view('admindashboard.courses',['course'=>$coursedesc]);
    }
    public function createcourses(Request $request){
       $course = new Course;
       $course->name = $request->name;
       $course->description = $request->desc;
       $course->teacher_id = $request->teacherid;
       $course->save();
        return redirect('/admin/courses');
    }
    public function showcreatecourses(Request $request){
        $allTeachers = Teacher::all();
        return view('admindashboard.showcourses',['teacher'=>$allTeachers]);
    }

    public function viewcourse(Request $request,$id=1){
        $courseid = $id;//$request->query('courseid');
        $coursedetails = Course::find($courseid);
        $coloumns = Schema::getColumnListing('courses');
        $coloumns = array_diff($coloumns,['teacher_id']);
        return view('admindashboard.viewcourse',['item'=>$coursedetails,'column'=>$coloumns]);
    }
    public function publishcourse(Request $request){
        $status_enum = ['enabled','disabled']; //change it to something dynamic, where it will take the value frm the enum class
        $courseid = $request->query('courseid');
        $coursedetails = Course::find($courseid);
        $new_status = array_values(array_diff($status_enum,[$coursedetails->status]));
        $coursedetails->status = $new_status[0];
        $coursedetails->save();
        return redirect('/admin/courses');
    }
    public function vieweditcourse(Request $request,$id){
        $coursedetails = Course::find($id);
        return view('admindashboard.editcourse',['item'=>$coursedetails]);
    }
    public function updateeditcourse(Request $request,$id){
        $coursedetails = Course::find($id);
        $coursedetails->name = $request->name;
        $coursedetails->description = $request->desc;
        $coursedetails->save();
        return redirect('/admin/viewcourse/'.$id);
    }
    public function deletecourse(Request $request){
        $courseid = $request->query('courseid');
        $course = Course::destroy($courseid);
        return redirect('/admin/courses');
    }
}

