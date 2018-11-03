<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\products;
use Mail;
class AuthController extends Controller
{
    //
    
     public function postlogin(Request $request)
     {
        if (Auth::attempt(['name'=> $request->name, 'password'=>$request->password])) {
            
         }
            $account = Auth::user();
            return response([
                'account'=>$account
            ]);
     }
     public function getlistuser(Request $request)
     {
       $listUser =User::orderByDesc('id')->get();
       return response([
            'listUser' => $listUser
       ]);
     }
    public function postaddUser(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:5',
            'email' => 'required',
            'password'=>'required|min:6|max:20',
            'gender'=>'required',
        ],
        [
            'name.required'=>'Bạn chưa nhâp tên sản phẩm',
            'name.min'=>'Tên sản phẩm phải nhiều hơn 5 kí tự',
            'email.required'=>'Bạn chưa nhâp email',
            'password.required'=>'Bạn chưa nhập mật khẩu',
            'password.min'=>'Mật khẩu trên phải 6 kí tự',
            'password.max'=>'Mật khẩu dưới phải 20 kí tự',
            'gender.required'=>'Bạn  chưa chọn giới tính',
        ]);
    	$user =new User();
    	$user->name = $request->name;
    	$user->password = bcrypt($request->password);
    	$user->email = $request->email;
        $user->role ='mai';
    	$user->gender = $request->gender;
    	$user->save();
        $products = products::all();
        $data=
        [
            'email'=>$request->email,
            'name'=>$request->name
        ];
        Mail::send('mail.mail',$data,function($message) use($data){
            $message->from('phamquycntta@gmail.com','anhquy');
            $message->to('phamquycntta999@gmail.com');
            $message->subject($data['name']);
        });
        return response([
            'products'=>$products
        ]);
    }

    public function getlogout()
    {
        Auth::logout();
        $account = Auth::user();
        return response([
            'account'=>$account
        ]);
    }
    public function posteditUser(Request $res,$id)
    {
        $user =  User::find($id);
        $user->name = $res->name;
        $user->level = $res->level;
        $user->email = $res->email;
        $user->save();
    }
    public function getsearch($search){
        $user = User::where('name','like','%'.$search.'%')->orderByDesc('id')->get();
        return response([
            'user'=>$user
        ]);
    }
    public function getsearchblank(){
        $user = User::orderByDesc('id')->get();
        return response([
            'user'=>$user
        ]);
    }
}
