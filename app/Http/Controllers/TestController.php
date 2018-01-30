<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;

class TestController extends Controller
{
    //

    public function test(){
        $temp = Test::where("h", "hello")->count();
        return $temp;
    }
}
