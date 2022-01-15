<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Schema;

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
        
        return view('admindashboard.students.createstudent');
    }


    public function store(Request $request)
    {
        $student = new User;
        $student->name = $request->name;
        $student->email = $request->email;
        $student->password = bcrypt('123456');
        $student->save();
        return redirect('/admin/students');
    }

    
    public function show($id)
    {
        $studentview = User::find($id);
        $coloumns = Schema::getColumnListing('users');
        return view('admindashboard.students.viewstudent',['item'=>$studentview,'column'=>$coloumns]);
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
