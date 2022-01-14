<?php

namespace App\Http\Controllers\Admin;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

abstract class Querytype{
    const create = "CreateTeachers";
    const update = "UpdateTeachers";
    public static function obtain($query){
        switch($query){
            case "CreateTeachers":
                return(self::create);
                break;
            case "UpdateTeachers":
                return(self::update);
                break;
            default:
                echo("Not working");
        }
    }
}

class HomeController extends Controller
{
    public function showteachers(Request $request)
    {
        $teacher = Teacher::all();
        return view('admindashboard.teachers',['teacher'=>$teacher,'param'=>$request->query('action')]);
    }
    public function createorupdatepage(Request $request){
        if($request->input('teacherid')){
            $teachersid = $request->input('teacherid');
            return View::make('admindashboard.createorupdateteacher')->with('teacher', Teacher::find($teachersid));
        }
        $teacher = Teacher::all();
        return view('admindashboard.createorupdateteacher',['teacher'=>$teacher,'param'=>$request->input('teacherid')]);
    }
    public function createorupdateform(Request $request){
        $querytype = Querytype::obtain($request->query('action'));
        $teacher = new Teacher;
        switch($querytype){
            case Querytype::create:
                $teacher->name = $request->name;
                $teacher->email = $request->email;
                $teacher->password = bcrypt('123456');
                $teacher->save();
                return redirect('/admin/teachers');
                break;
            case Querytype::update:
                $teacherid = $request->teacherid;
        }
        
        return view('admindashboard.createorupdateteacher',['teacher'=>$teacher,'param'=>$request->input('teacherid')]);
    }
}

