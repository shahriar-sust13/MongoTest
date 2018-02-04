<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Course;
use App\Dropper;
use App\CourseRequest;
use App\Post;

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

    public function showCourseProfile($id, $tab){
    	$userId = \Auth::user()->id;
    	if( $this->checkAdmin() == false ){
    		if( $tab == 3 )
    			return 'No Permission';
    		$userSession = \Auth::user()->reg;
    		$userSession = substr($userSession, 0, 4);
    		$courseSession = Course::find($id)->first()->session;
    		if( $userSession != $courseSession ){
    			if( Dropper::where('course_id', $id)->where('user_id', $userId)->count() == 0 )
    				return view('course-request', compact('id'));
    		}
    	}
    	$totalRequest = CourseRequest::where('course_id', $id)->count();
    	if( $tab == 3 ){
    		$requests = $this->getRequest($id);
    		return view('course', compact('id', 'tab', 'totalRequest', 'requests'));
    	}
    	if( $tab == 2 ){
    		$posts = Post::where('type', 2)->where('course_id', $id)->get();
    		foreach($posts as $post){
    			$user = User::where('_id', $post->user_id)->first();
    			$post->name = $user->name;
    			//$post->image_id = $user->image_id;
    			$post->image_id = 0;
    		}
    		return view('course', compact('id', 'tab', 'totalRequest', 'posts'));
    	}
    	return view('course', compact('id', 'tab', 'totalRequest'));
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
