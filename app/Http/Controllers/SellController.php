<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\bills;
class SellController extends Controller
{
    //
    public function getsearchdate($dateStar,$dateEnd)
    {   $date1 = date_create($dateStar);
        $date2 = date_create($dateEnd);
        $dateStar = date_format($date1, 'Y-m-d H:i:s');
        $dateEnd = date_format($date2, 'Y-m-d H:i:s');
        $listOrdersSearch = bills::whereBetween('created_at', [$dateStar, $dateEnd])->get();
        return response([
            'listSellSearch'=>$listSellSearch
        ]);
    }
    public function getlist(){
        $profit = bills::with('bill_details')->where('status','=',4)->orderByDesc('id')->get();
        $listProfitSearchnew = bills::where('status','=',4)->orderByDesc('id')->get();
        $summoney = 0;
        $sum = 0;
        foreach($listProfitSearchnew as $row){
            foreach ($row->bill_details as $key ) {
                $summoney =  $key->finance;
                $sum += $summoney; 
            }   
        }
        $doanhsothudc = $listProfitSearchnew->sum('sum');
        return response([
            'profit' => $profit,
            'doanhsothudc' => $doanhsothudc ,
            'sum'=> $sum,
        ]);
    }
}
