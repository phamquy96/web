<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\products;
use Carbon\Carbon;  
class InventoryController extends Controller
{
    //
    public function getchoose($choose)
    {
    	if($choose == 1){
    		$products = products::where('soluong','>',0)->orderByDesc('id')->get();
            $qty =  $products->sum('soluong');
            $summoneyiventon =  $products->sum('importprices');
            $summoney =  $products->sum('price');
            $date = Carbon::now();
            $datenow = date_format($date, 'd-m-Y');
    	}
    	elseif($choose == 2){
    		$products = products::where('soluong','=',0)->orderByDesc('id')->get();
            $qty =  0;
            $summoneyiventon =  0;
            $summoney = 0;
            $date = Carbon::now();
            $datenow = date_format($date, 'd-m-Y');
    	}
    	elseif($choose == 0){
    		$products = products::orderByDesc('id')->get();
            $qty =  $products->sum('soluong');
            $summoneyiventon =  $products->sum('importprices');
            $summoney =  $products->sum('price');
            $date = Carbon::now();
            $datenow = date_format($date, 'd-m-Y');
    	}
    	return response([
    		'products'=>$products,
            'qty' => $qty,
            'summoney' => $summoney,
            'summoneyiventon' => $summoneyiventon,
            'datenow' => $datenow
    	]); 
    }
    public function getsearch($search){
    	$products = products::where('name','like','%'.$search.'%')->orderByDesc('id')->get();
    	$date = Carbon::now();
        $datenow = date_format($date, 'd-m-Y');
    	return response([
    		'products'=>$products,
            'datenow' => $datenow
    	]);
    }
    public function getsort($sort){
    	if($sort == 1){
    		$products = products::orderByDesc('price')->get();
            $date = Carbon::now();
            $datenow = date_format($date, 'd-m-Y');
    	}
    	elseif($sort == 2){
    		$products = products::orderBy('id')->get();
            $date = Carbon::now();
            $datenow = date_format($date, 'd-m-Y');
    	}
    	elseif($sort == 0){
    		$products = products::orderByDesc('id')->get();
            $date = Carbon::now();
            $datenow = date_format($date, 'd-m-Y');
    	}
    	return response([
    		'products'=>$products,
            'datenow' => $datenow
    	]);
    }
    public function getsearchblank(){
    	$products = products::orderByDesc('id')->get();
    	return response([
    		'products'=>$products
    	]);
    }
}
