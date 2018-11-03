<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Warehouse;
use App\bills;
class ProfitController extends Controller
{
    //
    public function getsearchdate($dateStar,$dateEnd)
    {   
        $date1 = date_create($dateStar);
        $date2 = date_create($dateEnd);
        $dateStar = date_format($date1, 'Y-m-d H:i:s');
        $dateEnd = date_format($date2, 'Y-m-d H:i:s');
        $listProfitSearch = bills::with('bill_details')->whereBetween('created_at', [$dateStar, $dateEnd])->where('status','=',4)->get();
        $listProfitSearchnew = bills::whereBetween('created_at', [$dateStar, $dateEnd])->where('status','=',4)->get();
        $summoney = 0;
        $sum = 0;
        foreach($listProfitSearchnew as $row){
            foreach ($row->bill_details as $key ) {
                $summoney =  $key->finance;
                $sum += $summoney; 
            }   
        }
        $doanhsothudc = $listProfitSearch->sum('sum');
        return response([
            'listProfitSearch' => $listProfitSearch,
            'doanhsothudc' => $doanhsothudc ,
            'sum'=> $sum
        ]);
    }
    // public function getsearchdate($dateStar,$dateEnd)
    // {   $date1 = date_create($dateStar);
    //     $date2 = date_create($dateEnd);
    //     $dateStar = date_format($date1, 'Y-m-d H:i:s');
    //     $dateEnd = date_format($date2, 'Y-m-d H:i:s');
    //     $listProfitSearch = Warehouse::whereBetween('created_at', [$dateStar, $dateEnd])->get();
    //     return response([
    //         'listProfitSearch'=>$listProfitSearch
    //     ]);
    // }
}
