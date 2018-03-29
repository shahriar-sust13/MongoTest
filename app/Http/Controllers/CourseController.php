<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Course;
use App\Dropper;
use App\CourseRequest;
use App\Post;
use App\File;
use App\Question;
use App\Answer;
use App\Point;

class CourseController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function checkAdmin(){
    	$userType = \Auth::user()->type;
    	if( $userType == 1 )
    		return true;
    	return false;
    }

    function getRequest($courseId){
    	$requests = CourseRequest::where('course_id', $courseId)->paginate(10);
    	foreach( $requests as $request ){
    		$request->name = User::find($request->user_id)->name;
    	}
    	return $requests;
    }

    function getPoint($type, $post_id){
        if( Point::where('type', (string)$type)->where('post_id', (string)$post_id)->count() == 0 )    return -1;
        $score = Point::where('type', (string)$type)->where('post_id', (string)$post_id)->first()->score;
        return $score;
    }

    public function showCourseProfile($id, $tab){
    	$userId = \Auth::user()->id;
    	if( $this->checkAdmin() == false ){
    		if( $tab == 3 )
    			return 'No Permission';
    		$userSession = \Auth::user()->reg;
    		$userSession = substr($userSession, 0, 4);
    		$courseSession = Course::find($id)->session;
    		if( $userSession != $courseSession ){
    			if( Dropper::where('course_id', $id)->where('user_id', $userId)->count() == 0 )
    				return view('course-request', compact('id'));
    		}
    	}
        $course_name = Course::find($id)->name;
    	$totalRequest = CourseRequest::where('course_id', $id)->count();
    	if( $tab == 3 ){ // course requests
    		$requests = $this->getRequest($id);
    		return view('course', compact('id', 'course_name', 'tab', 'totalRequest', 'requests'));
    	}
    	if( $tab == 2 ){ // posts from the students
    		$posts = Post::where('type', 2)->where('course_id', $id)->orderBy('created_at', 'desc')->paginate(5);
    		foreach($posts as $post){
    			$user = User::where('_id', $post->user_id)->first();
    			$post->name = $user->name;
    			//$post->image_id = $user->image_id;
    			$post->image_id = 0;
    		}
    		return view('course', compact('id', 'course_name', 'tab', 'totalRequest', 'posts'));
    	}
    	if( $tab == 1 ){ // post from the teacher
    		$posts = Post::where('type', 1)->where('course_id', $id)->orderBy('created_at', 'desc')->paginate(5);
    		foreach($posts as $post){
    			$user = User::where('_id', $post->user_id)->first();
    			$post->name = $user->name;
    			if( File::where('post_id', $post->id)->count()>0 ){
    				$file = File::where('post_id', $post->id)->first();
    				$post->file_id = $file->id;
    			}
    			//$post->image_id = $user->image_id;
    			$post->image_id = 0;
    		}
    		return view('course', compact('id', 'course_name', 'tab', 'totalRequest', 'posts'));
    	}
        if( $tab == 4 ){ // question tab
            $questions = Question::where('course_id', $id)->orderBy('created_at', 'desc')->paginate(5);
            foreach($questions as $question){
                $user = User::where('_id', $question->author)->first();
                $question->author_name = $user->name;
            }
            return view('course', compact('id', 'course_name', 'tab', 'totalRequest', 'questions'));
        }
        if( $tab == 5 ){
            $questions = Question::where('course_id', $id)->get();
            $points = [];
            foreach($questions as $question){
                if( array_key_exists($question->author, $points) ){
                    $value = (int)($this->getPoint(1, $question->_id));
                    if( $value != -1 )
                        $points[$question->author] += $value;
                }
                else{
                    $value = (int)($this->getPoint(1, $question->_id));
                    if( $value != -1 )
                        $points[$question->author] = $value;
                }
                $answers = Answer::where('question_id', $question->_id)->get();
                $question->answers = $answers;
                
                foreach($answers as $answer){
                    if( array_key_exists($answer->author, $points) ){
                        $value = (int)($this->getPoint(1, $answer->_id));
                        if( $value != -1 )
                            $points[$answer->author] += $value;
                    }
                    else{
                        $value = (int)($this->getPoint(1, $answer->_id));
                        if( $value != -1 )
                            $points[$answer->author] = $value;
                    }
                }

            }
            arsort($points);
            $students = [];
            foreach($points as $key => $score){
                $user = User::find($key);
                $student['name'] = $user->name;
                $student['regno'] = $user->reg;
                $student['score'] = $score;
                array_push($students, $student);
            }
            return view('course', compact('id', 'course_name', 'tab', 'totalRequest', 'students'));
        }
    	return view('course', compact('id', 'course_name', 'tab', 'totalRequest'));
    }

    public function showCourseForm(){
    	if( $this->checkAdmin() == true )
    		return view('course-form');
    	return 'You don\'t have the permission';
    }

    public function addCourse(Request $request){
    	if( $this->checkAdmin() == false )
    		return 'You don\'t have the permission';
    	$course = new Course;
    	$course->name = $request->name;
    	$course->session = $request->session;
    	$course->save();
    	return redirect('course/'.$course->id.'/1');
    }

    public function courseRequest($id){
    	if( $this->checkAdmin() == true )
    		return redirect('course/'.$id.'/1');
    	$userSession = \Auth::user()->reg;
    	$userSession = substr($userSession, 0, 4);
    	$courseSession = Course::find($id)->first()->session;
    	if( $userSession == $courseSession )
    		return redirect('course/'.$id.'/1');
    	$userId = \Auth::user()->id;
    	$totalRequest = CourseRequest::where('course_id', $id)->where('user_id', $userId)->count();
    	if( $totalRequest>0 )
  			return 'Request Already Sent';
    	$courseRequest = new CourseRequest;
    	$courseRequest->course_id = $id;
    	$courseRequest->user_id = $userId;
    	$courseRequest->save();
    	return 'Request Sent';
    }

    public function acceptRequest($course_id, $user_id){
    	if( $this->checkAdmin() == false )
    		return redirect('course/'.$course_id.'/1');
    	CourseRequest::where('course_id', $course_id)->where('user_id', $user_id)->delete();
    	$dropper = new Dropper;
    	$dropper->course_id = $course_id;
    	$dropper->user_id = $user_id;
    	$dropper->save();
    	return redirect('course/'.$course_id.'/3');
    }

    public function declineRequest($course_id, $user_id){
    	if( $this->checkAdmin() == false )
    		return redirect('course/'.$course_id.'/1');
    	CourseRequest::where('course_id', $course_id)->where('user_id', $user_id)->delete();
    	return redirect('course/'.$course_id.'/3');
    }
}
