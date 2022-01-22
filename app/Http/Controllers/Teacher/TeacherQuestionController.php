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
class TeacherQuestionController extends Controller
{
   
    public function store(Request $request)
    {
       $newquestion = new Questions;
       $newquestion->question = $request->question;
       $newquestion->test_id = $request->testid;
       $newquestion->save();
       return redirect('/teacher/test/'.$request->testid);
        
    }
    public function destroy(Request $request,$id)
    {
        $question = Questions::destroy($id);
        return redirect('/teacher/test/'.$request->testid);
    }
}
