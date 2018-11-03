<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\bill_details;
use App\bills;
use App\customers;
use Cart;
use Carbon\Carbon;
use App\products;
use App\Warehouse;
use Mail; 
class OrderController extends Controller
{
    //
    public function postcart(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|between:5,20',
            'phone'=>'required|min:3|integer',
            'gender'=>'required',
        ],
        [
            'name.required'=>'Bạn chưa nhập tên',
            'name.between'=>'Tên trong khoảng 5 đến 20 kí từ ',
            'phone.required'=>'Bạn chưa nhập số điện thoại',
            'phone.integer'=>'Số điện thoại phải là số ',
            'phone.min'=>'Số điện thoại lớn hơn  3 chữ số ',
            'gender.required'=>'Bạn chưa chọn giới tính',
        ]);
        $customers = new customers();
        $customers->name = $request->name;
        $customers->email = 'phamquy@gmail.com';
        $customers->address = 'phamquydâds';
        $customers->note = 'phamquydâds';
        $customers->phone = $request->phone;
        $customers->gender = $request->gender;
        $customers->soluong = Cart::count();
        $customers->save();
        $id_custommer=$customers->id;
        $bills = new bills();
        $bills->name = $request->name;
        $bills->date_order =  Carbon::now();
        $bills->sum =Cart::subtotal(0,0,'');
        $bills->note = "Ngân hàng";
        $bills->payment = 1;
        $bills->status  = 1;
        $bills->save();
        $id_bills=$bills->id;
        foreach(Cart::content() as $row) {
            $bill_details = new bill_details();
            $bill_details->name = $row->name;
            $bill_details->price = $row->price;
            $bill_details->image = $row->options->has('image') ? $row->options->image : '';
            $bill_details->soluong = $row->qty;
            $bill_details->sum = ($row->qty)*($row->price);
            $bill_details->id_bill = $id_bills;
            $bill_details->id_products = $row->id;
            $bill_details->content = 'trong';
            $products = products::find($row->id);
            $products->soluong = ($products->soluong - $bill_details->soluong);
            $bill_details->finance = $products->importprices;
            $bill_details->save();
            $products->save(); 
             $data=
            [
                'name'=>$request->name,
                'date_order'=>$bills->date_order,
                'sum'=>$bills->sum,
                'soluong'=> $row->qty,
                'tensp'=>$row->name
                
            ];
             Mail::send('mail.mail',$data,function($message) use($data){
            $message->from('phamquycntta@gmail.com','anhquy');
            $message->to('phamquycntta999@gmail.com');
            $message->subject($data['name']);
            });
        }
        
        Cart::destroy();
        $countCart = Cart::count();
        return response([
            'countCart' => $countCart
        ]);
    }
    public function getlistorders(){
        $listOrders = bills::orderByDesc('id')->get();
        return response([
            'listOrders'=>$listOrders,
        ]);
    } 
    public function getlistinventory(){
        $listInventory = products::orderByDesc('id')->where('soluong','>','0')->get();
        $qtyInventory = products::where('soluong','>','0')->sum('soluong');
        $moneyInventory = products::where('soluong','>','0')->sum('price');
        $importmoneyInventory = products::where('soluong','>','0')->sum('importprices');
        $date = Carbon::now();
        $datenow = date_format($date, 'd-m-Y');
        return response([
            'listInventory'=>$listInventory,
            'qtyInventory'=>$qtyInventory,
            'moneyInventory'=>$moneyInventory,
            'importmoneyInventory'=>$importmoneyInventory,
            'datenow' => $datenow
        ]);
    }
    public function getlistcustomer(){
        $listCustomer = customers::orderByDesc('id')->get();
        $qtyInventory = products::where('soluong','>','0')->sum('soluong');
        $moneyInventory = products::where('soluong','>','0')->sum('price');
        return response([
            'listCustomer'=>$listCustomer,
            'qtyInventory'=>$qtyInventory,
            'moneyInventory'=>$moneyInventory
        ]);
    }
    public function postorders(Request $request,$id){
       $bills = bills::find($id);
       // $name = $bills->customer->name;
       // echo"$name";
       $bills->status =  $request->statuschange;
       $data=
        [
            'status'=>$request->statuschange,
        ];
        Mail::send('mail.statusOrders',$data,function($message) use($data){
            $message->from('phamquycntta@gmail.com','anhquy');
            $message->to('phamquycntta999@gmail.com');
            $message->subject('phamquy');
        });
       $bills->save();
    } 
    public function getsearchdate($dateStar,$dateEnd)
    {   $date1 = date_create($dateStar);
        $date2 = date_create($dateEnd);
        $dateStar = date_format($date1, 'Y-m-d H:i:s');
        $dateEnd = date_format($date2, 'Y-m-d H:i:s');
        $listOrdersSearch = bills::whereBetween('created_at', [$dateStar, $dateEnd])->get();
        return response([
            'listOrdersSearch'=>$listOrdersSearch
        ]);
    }
    public function getlistphieuthu(){
        $listphieuthu = bills::where('status','=',4)->orderByDesc('id')->get();
        return response([
            'listphieuthu' => $listphieuthu 
        ]);
    }
    public function getsearchdatephieuthu($dateStar,$dateEnd)
    {   $date1 = date_create($dateStar);
        $date2 = date_create($dateEnd);
        $dateStar = date_format($date1, 'Y-m-d H:i:s');
        $dateEnd = date_format($date2, 'Y-m-d H:i:s');
        $listphieuthu = bills::whereBetween('created_at', [$dateStar, $dateEnd])->orderByDesc('id')->get();
        return response([
            'listphieuthu'=>$listphieuthu
        ]);
    }
    public function getsearchdatephieuchi($dateStar,$dateEnd)
    {   $date1 = date_create($dateStar);
        $date2 = date_create($dateEnd);
        $dateStar = date_format($date1, 'Y-m-d H:i:s');
        $dateEnd = date_format($date2, 'Y-m-d H:i:s');
        $listPhieuchi = Warehouse::whereBetween('created_at', [$dateStar, $dateEnd])->orderByDesc('id')->get();
        return response([
            'listPhieuchi'=>$listPhieuchi
        ]);
    }
    public function getdeleteOrder($id){
        $bills =  bills::find($id);
        $bills->delete();
    }
    public function getdeleteCustomer($id){
        $customers = customers::find($id);
        $customers->delete();
    }
    
}
