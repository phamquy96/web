<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\cates;
use App\subcates;
class SubcatesController extends Controller
{
    //
    public function getCates()
    {
        $cates = cates::all();
        $subcates = subcates::all();
        return response([
            'cates'=> $cates,
            'subcates'=> $subcates
        ]);
    }
    
    public function postAddSubCates(Request $res)
    {  
    	$subcates = new subcates;
    	$subcates->sub_catetitle = $res->name;
    	$subcates->image = $res->image;
    	$subcates->keyword = $res->name;
    	$subcates->id_cates = $res->cates_id;
    	$subcates->save();
    }
    public function getdeleteSubcates($id)
    {
        $subcates = subcates::find($id);
        $subcates->delete();
    }
}
