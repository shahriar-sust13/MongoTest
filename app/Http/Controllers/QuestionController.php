<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\User;
use App\Dropper;
use App\Course;
use App\Answer;

class QuestionController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function isRegistered($course_id, $user_id){
    	$user = User::find($user_id);
    	if( $user->type == 1 )	return true;
    	$user_session = $user->reg;
    	$user_session = substr($user_session, 0, 4);
    	$course_session = Course::find($course_id)->first()->session;
    	if( $user_session != $course_session ){
    		if( Dropper::where('course_id', $course_id)->where('user_id', $user_id)->count() == 0 )
    			return false;
    	}
    	return true;
    }

    public function addQuestion(Request $request, $course_id){
    	$user_id = \Auth::user()->id;
    	$question = new Question;
    	$question->author = $user_id;
    	$question->course_id = $course_id;
    	$question->description = $request->description;
    	$question->save();
    	return redirect('/course/'.$course_id.'/4');
    }

    public function showQuestion($id){
    	if( Question::where('_id', $id)->count() == 0 )	return redirect('home');
    	$user = \Auth::user();
    	$user_id = $user->id;
    	$question = Question::find($id);
        $question->author_name = User::find($question->author)->name;
    	$course_id = $question->course_id;
    	if( $this->isRegistered($course_id, $user_id) == false ){
    		return view('course-request', compact('course_id'));
    	}
    	if( $user_id != $question->author && Answer::where('question_id', $id)->where('author', $user_id)->count() == 0 && $user->type != 1 )
    		return view('question', compact('id', 'question'));
    	$answers = Answer::where('question_id', $id)->orderBy('created_at', 'desc')->get();
    	foreach($answers as $answer){
    		$answer->author_name = User::find($answer->author)->name;
    	}
    	return view('question', compact('id', 'question', 'answers'));
    }

    public function addAnswer(Request $request, $question_id){
    	$user_id = \Auth::user()->id;
    	$question = Question::find($question_id);
    	$course_id = $question->course_id;
    	if( $this->isRegistered($course_id, $user_id) == false )
    		return redirect('home');
    	$answer = new Answer;
    	$answer->author = $user_id;
    	$answer->question_id = $question_id;
    	$answer->description = $request->description;
    	$answer->save();
    	return redirect('question/'.$question_id);
    }
}
