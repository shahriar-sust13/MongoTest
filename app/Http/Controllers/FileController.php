<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;

class FileController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function downloadFile($file_id){
    	$file_name = $file_id . '.' . File::find($file_id)->extension;
    	$file_path = public_path().'\\resources\\'.$file_name;
    	return response()->download( $file_path );
    }
}
