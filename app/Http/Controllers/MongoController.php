<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;

class MongoController extends Controller
{
    //

    public function showPage(){
    	//phpinfo();
    	$profile = Profile::where("name", "nazim")->first();
    	return $profile->age;
    	return "hello from the test";
    }
}
