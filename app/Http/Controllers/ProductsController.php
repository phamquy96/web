<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\products;
use Cart;
use Auth;
use Carbon\Carbon;
use App\bills;
class ProductsController extends Controller
{
    //
    public function postAddProducts(Request $res)
    {
        
    	$products = new products();
    	$products->name = $res->name;
    	$products->price = $res->price;
    	$products->id_subcates =$res->subcates_id;
    	$products->discount = $res->discount;
    	$products->thongsokithuat = $res->thongsokithuat;
    	$products->thongtinkhuyenmai = $res->thongtinkhuyenmai;
    	$products->keyword = $res->name;
        $products->importprices = $res->importprice;
    	$products->image = $res->image;
        $products->soluong = $res->qty;
    	$products->save();
        $productsall = products::select('name','image','price')->orderByDesc('id')->get();
    	return response([
    		'products'=>$products,
            'productsall'=>$productsall
    	]);
    } 
    public function getListgetproducts()
    {
        $products = products::with('subcates')->select('name','image','price','id_subcates','id','soluong','importprices')->orderByDesc('id')->get();
        $count_cart = Cart::count();
        $account = Auth::user();
        return response([
            'account'=>$account,
            'products'=>$products,
            'count_cart'=>$count_cart
        ]);
    }
    public function postUpdateProducts(Request $res,$id)
    {
        $products =  products::find($id);
        $products->name = $res->name;
        $products->price = $res->price;
        $products->id_subcates =$res->subcates_id;
        $products->discount = $res->discount;
        $products->thongsokithuat = $res->thongsokithuat;
        $products->thongtinkhuyenmai = $res->thongtinkhuyenmai;
        $products->keyword = $res->name;
        $products->image = $res->image;
        $products->save();
        return response([
            'products'=>$products
        ]);
    }

    public function paginateProducts($page){
        $list_papers = products::count();
        $per_page = 8;
        $pageCount = ceil($list_papers / $per_page);
        $start = ($page - 1) * $per_page;
        $list_papers = products::skip($start)->limit($per_page)->get();
        return response([
            'pageCount'=>$pageCount,
            'list_papers'=>$list_papers,
            'per_page'=>$per_page,
            'page'=>$page,
        ]);
// // BƯỚC 5: TRUY VẤN LẤY DANH SÁCH TIN TỨC
// // Có limit và start rồi thì truy vấn CSDL lấy danh sách tin tức
// $result = mysqli_query($conn, "SELECT * FROM news LIMIT $start, $limit");
    } 
    public function getDelete($id){
        $products = products::find($id);
        $products->delete();
    }
    public function getchoose($choose)
    {
        if($choose == 1){
            $products = products::with('subcates')->where('status','=',0)->orderByDesc('id')->get();
        }
        elseif($choose == 0){
           $products = products::with('subcates')->where('status','=',1)->orderByDesc('id')->get();
        }
        elseif($choose == 2){
            $products = products::with('subcates')->where('soluong','=',0)->orderByDesc('id')->get();
        }
        elseif($choose == 3){
            $products = products::with('subcates')->where('soluong','<',5)->orderByDesc('id')->get();
        }
        return response([
            'products'=>$products
        ]); 
    }
    public function getsearch($search){
        $products = products::with('subcates')->where('name','like','%'.$search.'%')->orderByDesc('id')->get();
        
        return response([
            'products'=>$products
        ]);
    }
    public function getsort($sort){
        if($sort == 4){
            $products = products::with('subcates')->orderByDesc('price')->get();
        }
        elseif($sort == 3){
            $products = products::with('subcates')->orderBy('id')->get();
        }
        elseif($sort == 0){
            $products = products::with('subcates')->orderByDesc('id')->get();
        }
        elseif($sort == 1){
            $products = products::with('subcates')->orderBy('name')->get();
        }
        elseif($sort == 2){
            $products = products::with('subcates')->orderByDesc('name')->get();
        }
        return response([
            'products'=>$products
        ]);
    }
    public function getsearchblank(){
        $products = products::with('subcates')->orderByDesc('id')->get();
        return response([
            'products'=>$products
        ]);
    }
    public function getListpages(){
        $today = Carbon::today();
        $tomorrow = Carbon::tomorrow();
        $sum = bills::whereBetween('created_at', [$today, $tomorrow])->where('status','<',5)->sum('sum');
        $count = bills::whereBetween('created_at', [$today, $tomorrow])->count();
        $Profit = bills::whereBetween('created_at', [$today, $tomorrow])->where('status','<',5)->get();
        $summoney = 0;
        $sumprofit = 0;
        foreach($Profit as $row){
            foreach ($row->bill_details as $key ) {
                $summoney =  $key->finance;
                $sumprofit += $summoney; 
            }   
        }
        $profittoday = $sum - $sumprofit;
        $cancel = bills::whereBetween('created_at', [$today, $tomorrow])->where('status','=',5)->count();
        return response([
            'sum' => $sum,
            'count' => $count,
            'profittoday' => $profittoday,
            'cancel' => $cancel 
        ]);
    }
    public function geteditProducts($id){
        $editProductnew = products::with('subcates')->find($id);
        return response([
            'editProductnew' => $editProductnew
        ]);
    }
}

