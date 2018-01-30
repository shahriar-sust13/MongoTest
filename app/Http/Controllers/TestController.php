<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;
use App\User;

class TestController extends Controller
{
    //

    public function test(){
    	return \Auth::user()->id;
        $temp = Test::where("h", "hello")->count();
        return $temp;
    }
}
