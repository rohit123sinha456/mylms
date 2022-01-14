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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allcourses = Course::all();
        return view('admindashboard.selectlessoncourse',['courses'=>$allcourses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allCourses = Course::all();
        return view('admindashboard.createlesson',['course'=>$allCourses]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lessonid = $id;//$request->query('courseid');
        $lessondetails = Lesson::find($lessonid);
        $coloumns = Schema::getColumnListing('lessons');
        return view('admindashboard.viewlesson',['item'=>$lessondetails,'column'=>$coloumns]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Lesson::destroy($id);
        return redirect('/admin/lessons/'.$id);
    }
    public function viewcourselessons(Request $request){
        // use some table or stuff/ try to deal with tables and searchable stuff
        $courseid = $request->courseid;
        $courselessons = Lesson::where('course_id',$courseid)->get();
        return view('admindashboard.showlessoncourse',['courses'=>$courselessons]);
    }
}
