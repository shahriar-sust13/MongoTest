<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Point;
use App\Answer;

class PointController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addPoint(Request $request, $type, $post_id){
    	if( Point::where('type', $type)->where('post_id', $post_id)->count()>0 ){
    		Point::where('type', $type)->where('post_id', $post_id)->delete();
    	}
    	$point = new Point;
    	$point->type = $type;
    	$point->post_id = $post_id;
    	$point->score = $request->score;
    	$point->save();
    	if( $type == 1 )	return redirect('question/'.$post_id);
    	$question_id = Answer::find($post_id)->question_id;
    	return redirect('question/'.$question_id);
    }
}
