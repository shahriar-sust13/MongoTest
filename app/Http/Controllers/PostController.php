<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
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

    public function addPost(Request $request, $course_id){
    	$user_id = \Auth::user()->id;
    	if( $this->checkAdmin() == true ){
    		$post = New Post;
    		$post->type = 1; // 1 means Teacher Post
    		$post->user_id = $user_id;
    		$post->course_id = $course_id;
    		$post->description = $request->description;
    		$post->save();
    		return redirect('course/'.$course_id.'/1');
    	}
    	else{
    		$post = New Post;
    		$post->type = 2; // 2 means Student Post
    		$post->user_id = $user_id;
    		$post->course_id = $course_id;
    		$post->description = $request->description;
    		$post->save();
    		return redirect('course/'.$course_id.'/2');
    	}
    }
}
