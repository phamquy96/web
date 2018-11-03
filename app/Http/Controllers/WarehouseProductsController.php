<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\products;
use App\Warehouse_Products;
use App\Warehouse;
class WarehouseProductsController extends Controller
{
    //
    public function getaddsearchproducts($search){
    	$products = products::where('name','like','%'.$search.'%')->get();
    	return response([
    		'products'=>$products
    	]);
    }
    public function postproductskho(Request $request){
    	$warehouses = new Warehouse();
    	$warehouses->name = 'quy';
    	$summoney = 0;
    	$qtychange = 0;
    	$tongtamthoi = 0;
    	$soluongtamthoi = 0;
    	foreach ($request->Warehouse_Products as $row ) {
    		$sum =$row['thanhtien'];
    		$qty = $row['qtychange'];
    		$tongtamthoi += $sum;
    		$soluongtamthoi += $qty;
    	}
    	$qtychange  += $soluongtamthoi;
    	$summoney  += $tongtamthoi;
    	$warehouses->soluong = $qtychange;
    	$warehouses->sum = $summoney;
    	$warehouses->save();
    	foreach ($request->Warehouse_Products as $row ) {
    		$id= $row['id'];
    		$products = products::find($id);
    		$products->soluong = $products->soluong + $row['qtychange'];
            $products->price = $row['price'];
            $products->importprices = $row['importprices'];
    		$products->save();
		    $warehouse_Products = new Warehouse_Products();
			$warehouse_Products->name = $row['name'];
			$warehouse_Products->price = $row['price'];
			$warehouse_Products->sum = $row['thanhtien'];
			$warehouse_Products->qty = $row['qtychange'];
			$warehouse_Products->image = $row['image'];
			$warehouse_Products->donvi = 'cái';
			$warehouse_Products->id_warehouse = $warehouses->id;
			$warehouse_Products->save();
    	}
    	$warehouses = Warehouse::orderBy('id','Desc')->get();
    	return response([
    		'listTrade'=>$warehouses
    	]);
    }
    public function getlisttrade(){
    	$warehouse = Warehouse::orderBy('id','Desc')->get();
    	return response([
    		'listTrade'=>$warehouse
    	]);
    }
    public function getproductswarehouse(){
    	$warehouseProducts = Warehouse_Products::orderBy('id','Desc')->get();
    	return response([
    		'warehouseProducts'=>$warehouseProducts
    	]);
    }
    public function getdeletelisttrade($id){
        $warehouse = Warehouse::find($id);
        $warehouse->delete();
    }
    public function getsearchdate($dateStar,$dateEnd)
    {   $date1 = date_create($dateStar);
        $date2 = date_create($dateEnd);
        $dateStar = date_format($date1, 'Y-m-d H:i:s');
        $dateEnd = date_format($date2, 'Y-m-d H:i:s');
        $listWasehouesSearch = Warehouse::whereBetween('created_at', [$dateStar, $dateEnd])->get();
        return response([
            'listWasehouesSearch'=>$listWasehouesSearch
        ]);
    }
    public function getlistwarehouse($id){
        $warehouse_Products = Warehouse_Products::where('id_warehouse',$id)->orderByDesc('id')->get();
        return response([
            'warehouse_Products' => $warehouse_Products
        ]);
    }
    	
}