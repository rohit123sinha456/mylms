<?php
namespace App\Actions;

use App\Models\Test;
use App\Models\Questions;
use App\Models\Answers;
use App\Models\StudentAnswers;
class StudentResult
{
    public function getResult($tests,$student){
        $result = array();
        $studentanswers =  StudentAnswers::where('student_id',$student)->get();
        foreach($studentanswers as $sa){
            $correctanswer = Answers::find($sa->answer_id)->correct;
            //dump($correctanswer);
            if($correctanswer == true){
                $result[$sa->test_id] += 1;
            }
            else{
                $result[$sa->test_id] = 0;
            }
        }
        return($result);
    }

}
?>