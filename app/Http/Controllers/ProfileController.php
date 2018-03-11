<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Course;
use App\Dropper;

class ProfileController extends Controller
{
    //

    public function showProfile($id){
    	$user = User::find($id);
    	$user_name = $user->name;
    	$user_reg = $user->reg;
    	$user_session = substr($user_reg, 0, 4);
    	if( $user->type == 1 ){
    		$courses = Course::all();
    	}
    	else{
    		$courses = Course::where('session', $user_session)->get();
    		$drops = Dropper::where('user_id', $id)->get();
    		foreach($drops as $drop){
    			$course = Course::find($drop->course_id);
    			$courses[] = $course;
    		}
    	}	
    	return view('profile', compact('user_name', 'user_reg', 'courses'));
    }
}
