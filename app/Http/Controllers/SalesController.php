<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\bills;
class SalesController extends Controller
{
    //
    public function getlist(){
    	$listSales = bills::where('status',5)->orderby('id','Desc')->get();
    	$bills = bills::all();
    	$sumMoney = $bills->sum('sum');
    	return response([
    		'listSales'=>$listSales,
    		'sumMoney'=>$sumMoney
    	]);
    }
}
