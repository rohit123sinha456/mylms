<?php
namespace App\Actions;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Topic;

class TopicAction
{
    public function createTopic($topicname, $courseid){
        $newtopic = new Topic;
        $newtopic->course_id = $courseid;
        $newtopic->Topic = $topicname;
        $newtopic->save();
    }

    public function getTopic($courseid){
        $topics = Topic::where('course_id',$courseid)->get();
        return($topics);
    }
}
?>