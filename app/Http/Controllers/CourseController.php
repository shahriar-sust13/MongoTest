<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserInfo;
use App\Course;
use App\CourseRequest;

class CourseController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function checkAdmin(){
    	$userId = \Auth::user()->id;
    	$userType = UserInfo::where('userId', $userId)->first()->type;
    	if( $userType == 1 )
    		return true;
    	return false;
    }

    public function showCourseProfile($id, $tab){
    	$userId = \Auth::user()->id;
    	if( $this->checkAdmin() == false ){
    		$userSession = User::find($userId)->reg;
    		$userSession = substr($userSession, 0, 4);
    		$courseSession = Course::find($id)->first()->session;
    		if( $userSession != $courseSession )
    			return view('course-request', compact('id'));
    	}
    	return view('course', compact('id', 'tab'));
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
    	return 'hello';
    	if( $this->checkAdmin() == true )
    		return redirect('course/'.$id.'/1');
    	$userSession = \Auth::user()->reg;
    	$userSession = substr($userSession, 0, 4);
    	$courseSession = Course::find($id)->first()->session;
    	if( $userSession == $courseSession )
    		return redirect('course/'.$id.'/1');
    	$courseRequest = new CourseRequest;
    	$courseRequest->course_id = $id;
    	$courseRequest->user_id = \Auth::user()->id;
    	return 'Request Sent';
    }
}
