<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\CourseUser;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


use App\Http\Controllers\Controller;
class StudentController extends Controller
{
    
    public function index()
    {
        $allstudents = User::all();
        return view('admindashboard.students.showstudents',['students'=>$allstudents]);
    }

    
    public function create()
    {
        $courses = Course::all();
        return view('admindashboard.students.createstudent',['courses'=>$courses]);
    }


    public function store(Request $request)
    {
        $student = new User;
        $coursestudent = new CourseUser;
        $coursename = Course::find($request->courseid);
        try{
        $student->name = $request->name;
        $student->email = $request->email;
        $student->password = bcrypt('123456');
        $student->save();
        $coursestudent->user_id  = $student->id;
        $coursestudent->course_id = $request->courseid;
        $coursestudent->course_name = $coursename->name;
        }
        catch(Exception $e){
            return redirect('/admin/students');
        }
        $coursestudent->save();
        return redirect('/admin/students');
    }

    
    public function show($id)
    {
        $studentview = User::find($id);
        $studentcourses = CourseUser::where('user_id',$id)->get();
        $coloumns = Schema::getColumnListing('users');
        return view('admindashboard.students.viewstudent',['item'=>$studentview,'column'=>$coloumns,'studentcourses'=>$studentcourses]);
    }


    public function edit($id)
    {
        $studentdetails = User::find($id);
        return view('admindashboard.students.editstudent',['item'=>$studentdetails]);
    }

   
    public function update(Request $request, $id)
    {
        $studentdetails = User::find($id);
        $studentdetails->name = $request->name;
        $studentdetails->email = $request->email;
        $studentdetails->save();
        return redirect('/admin/students/'.$id);
    }

    public function destroy($id)
    {
        $course = User::destroy($id);
        return redirect('/admin/students');
    }
    public function publish($id)
    {
        //
    }
}
