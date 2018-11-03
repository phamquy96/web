<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cates;
class CatesController extends Controller
{
    //
    public function postAddCates(Request $res)
    {
    	$cates = new cates();
    	$cates->name = $res->name;
    	$cates->keyword = $res->name;
    	$cates->save();
    	return response([
    		'cates'=>$cates
    	]);
    }
    public function postproducts(Request $res,$id)
    {
        $cates =cates::find($id);
        $cates->name = $res->name;
        $cates->save();
    }
    public function getdeleteCates($id)
    {
        $cates =cates::find($id);
        $cates->delete();
    }
}
