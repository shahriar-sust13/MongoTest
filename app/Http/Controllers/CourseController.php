<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    //

    public function showCourseProfile($id, $tab){
    	return view('course', compact('id', 'tab'));
    }
}
