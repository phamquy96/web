<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function upload(Request $res)
	{
		$file=$res->file;
		$name= $file->getClientOriginalName();
		$file->move("img",$name); 
		return response([
            'result' => $name
        ], 200);
    }
    public  function uploadmultiple(Request $res)
    {	
    	 foreach ($res->files as $file) {
	 	    $name = $file[0]->getClientOriginalName();	
    	 	return response([
    	 		'result'=>$name
    	 	]);
    	 }
	}
}
