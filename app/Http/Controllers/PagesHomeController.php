<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\products;
use App\danhgia;
use App\reply_danhgia;
use App\comments;
use Cart;
use App\subcates;
use Auth;
use App\cates;
use App\replies;
use App\User;
use Cache;
class PagesHomeController extends Controller
{
    //
    public function getProductsHome()
	{
        $products = products::with('danhgias')->select('id','name','image','price','discount')->orderByDesc('id')->get();
        $randomProducts = products::with('danhgias')->select('id','name','image','price','discount')->inRandomOrder()->take(5)->get();
        $Products_List_Main = products::with('danhgias')->select('id','name','image','price','discount')->orderByDesc('id')->get();
        // $cates = cates::find(1);
        // $products = $cates->products()->danhgias(); 
        $List_SubCates = subcates::select('id','sub_catetitle','image')->get();
        return response([
            'result'=> $products,
            'randomProducts'=>$randomProducts,
            'Products_List_Main'=>$Products_List_Main,
            'List_SubCates'=>$List_SubCates,
        ],200);
        $cates = cates::find(1);
        $products = $cates->products;
    }
     public function getProducts()
    {
        $Products_List_Main = products::with('danhgias')->select('id','name','image','price','id_subcates','discount')->orderByDesc('id')->get();
        $List_SubCates = subcates::select('id','sub_catetitle','image')->get();
        $account = Auth::user();
        return response([
            'Products_List_Main'=>$Products_List_Main,
            'List_SubCates'=>$List_SubCates,
            'account' => $account
        ],200);
    }
    public function getproductsmain($id)
    {
        $product = products::with('danhgias')->where('id_subcates',$id)->orderByDesc('id')->get();
        $List_SubCates = subcates::all();
        return response([
            'product' => $product,
            'List_SubCates'=>$List_SubCates
        ], 200);
    }
    public function getsearchproducts($search)
    {
        $products = products::where('name','like','%'.$search.'%')->take(6)->get();
         return response([
            'products' => $products,
        ], 200);
    }
    public function getPriceDimished($keyword)
    {
        $products = products::where('name','like','%'.$keyword.'%')->orderByDesc('price')->get();
         return response([
            'products' => $products,
        ], 200);
    }
    public function getpPriceIncrement($keyword)
    {
        $products = products::where('name','like','%'.$keyword.'%')->orderBy('price')->get();
         return response([
            'products' => $products,
        ], 200);
    }
    
    public function getproductSubcates($id)
    {
        $products = products::with('danhgias')->where('id_subcates',$id)->select('id','name','image','price','importprices')->orderByDesc('id')->take(5)->get();
        return response([
            'products'=> $products
        ]);
    }
    public function getDetailProducts($id) 
    {
    	$product = products::find($id);
        $productlienquan = products::with('danhgias')->where('id_subcates',$product->id_subcates)->take(5)->get();
        $rating = danhgia::with('reply_danhgia')->where('id_products',$id)->orderByDesc('id')->get();
        $comment = comments::with('replies')->where('id_products',$id)->orderByDesc('id')->get(); // rep comment ở đâu
        $randomProducts = products::with('danhgias')->inRandomOrder()->take(4)->get();
        $totaldanhgia = danhgia::where('id_products',$product->id)->get();
        $trungbinhstar = $product->danhgias->avg('star');
        $lamtronstar =  ceil($trungbinhstar);
        $namsao =$product->danhgias->where('star',5)->count('star'); // :))
        $bonsao =$product->danhgias->where('star',4)->count('star');
        $basao =$product->danhgias->where('star',3)->count('star');
        $haisao =$product->danhgias->where('star',2)->count('star');
        $motsao =$product->danhgias->where('star',1)->count('star');
        $account = Auth::user();
    	return response([
            'result' => $product,
            'splienquan'=> $productlienquan,
            'rating'=> $rating,
            'comment'=> $comment,
            'randomProducts'=> $randomProducts,
            'totaldanhgia'=> $totaldanhgia,
            'lamtronstar'=> $lamtronstar,
            'namsao'=> $namsao,
            'bonsao'=> $bonsao,
            'basao'=> $basao,
            'haisao'=> $haisao,
            'motsao'=> $motsao,
            'account' => $account
        ], 200);
    }
    public function getcompareProducts($id,$in){
        $products  = products::with('danhgias')->find($id);
        $productCompare = products::with('danhgias')->find($in);
        // $product = $products->with('danhgias')->get();
        // $productCompare = $productCompare->with('danhgias')->get();
        $randomProducts = products::with('danhgias')->inRandomOrder()->take(5)->get();
        return response([
            'products'=> $products,
            'productCompare'=>$productCompare,
            'randomProducts'=>$randomProducts
        ]);
    }
    public function getaddsosanh($id){
         $sosanhthem  = products::with('danhgias')->find($id);
          return response([
            'sosanhthem'=> $sosanhthem,
        ]);
    }
     public function getsearchCompare($keyword){
          $resultProductsCompare = products::where('name','like','%'.$keyword.'%')->orderBy('price')->get();
          return response([
            'resultProductsCompare'=> $resultProductsCompare,
        ]);
    }
    public function getsearchPriceProducts($value){
        if($value == 0)
        {
            $products = products::with('danhgias')->orderByDesc('id')->get();
        }
        if($value == 1)
        {
            $products = products::with('danhgias')->where('price','<',2000000)->get();
        }
        if($value == 2)
        {
            $products = products::with('danhgias')->whereBetween('price',[2000000,4000000])->get();
        }
        if($value == 3)
        {
            $products = products::with('danhgias')->whereBetween('price',[4000000,7000000])->get();
        }
        if($value == 4)
        {
            $products = products::with('danhgias')->whereBetween('price',[7000000,12000000])->get();
        }
        if($value == 5)
        {
            $products = products::with('danhgias')->where('price','>',[13000000])->get();
        }
        if($value == 6)
        {
            $products = products::with('danhgias')->orderByDesc('price')->get();
        }
        if($value == 7)
        {
            $products = products::with('danhgias')->orderBy('price')->get();
        }
        return response([
            'products'=>$products
        ]);
    }
    public function getSearchany($keyword)
    {
        $products = products::where('name','like','%'.$keyword.'%')->get();
         return response([
            'products' => $products,
        ], 200);
    }
    public function postAddRating(Request $res)
    {
        $danhgia = new danhgia();
        $danhgia->name  =  Auth::user()->name;
        $danhgia->phone  =  $res->phone;
        $danhgia->email  =  $res->email;
        $danhgia->content  =  $res->content;
        $danhgia->star  =  $res->star;
        $danhgia->image  =  $res->image;
        $danhgia->id_user  = Auth::user()->id;
        $danhgia->id_products  = $res->id_products;
        $danhgia->save();
        $danhgia =danhgia::with('reply_danhgia')->where('id_products',$res->id_products)->orderByDesc('id')->get();
        return response([
            'danhgia'=>$danhgia
        ]);
    }
    public function postrepycmtdanhgia(Request $res)
    {
        $reply_danhgia = new reply_danhgia();
        $reply_danhgia->name = Auth::user()->name;
        $reply_danhgia->id_danhgia =$res->id_danhgia;
        $reply_danhgia->id_user =Auth::user()->id;
        $reply_danhgia->content =$res->content;
        $reply_danhgia->save();
        $sum_papers = danhgia::where('id_products',$res->id_products)->count();
        $per_page = 5;
        $pageCount = ceil($sum_papers / $per_page);
        $start = ($res->page - 1) * $per_page;
        $danhgia = danhgia::with('reply_danhgia')->where('id_products',$res->id_products)->skip($start)->limit($per_page)->orderByDesc('id')->get();
        $page = $res->page;
        return response([
            'result'=>$reply_danhgia,
            'danhgia'=>$danhgia,
            'pageCount'=>$pageCount,
            'per_page'=>$per_page,
            'page'=>$page,
        ]);
    }
    public function postrepycmt(Request $res)
    {
        $replies = new replies();
        $replies->name = Auth::user()->name;
        $replies->id_comment =$res->id_comment;
        $replies->id_user = Auth::user()->id;
        $replies->content =$res->content;
        $replies->save();
        $sum_papers = comments::where('id_products',$res->id_products)->count();
        $per_page = 5;
        $pageCount = ceil($sum_papers / $per_page);
        $start = ($res->page - 1) * $per_page;
        $comment = comments::with('replies')->where('id_products',$res->id_products)->skip($start)->limit($per_page)->orderByDesc('id')->get();
        $page = $res->page;
        return response([
            'result'=>$replies,
            'comment'=>$comment,
            'pageCount'=>$pageCount,
            'per_page'=>$per_page,
            'page'=>$page,
        ]);
    }
    public function paginateProducts($page){
        $sum_papers = products::count();
        $per_page = 15;
        $pageCount = ceil($sum_papers / $per_page);
        $start = ($page - 1) * $per_page;
        $list_papers = products::with('danhgias')->skip($start)->limit($per_page)->orderByDesc('id')->get();
        return response([
            'pageCount'=>$pageCount,
            'list_papers'=>$list_papers,
            'per_page'=>$per_page,
            'page'=>$page,
        ]);
    }
    public function postComment(Request $res)
    {

        $comment = new comments();
        $comment->name = Auth::user()->name;
        $comment->content = $res->content;
        $comment->id_products = $res->id_products;
        if($res->image)
        {
            $comment->image = $res->image;
        }
        else{
             $comment->image = 0;
        }
        $comment->id_user =  Auth::user()->id;
        $comment->save();
        $comments =comments::with('replies')->where('id_products',$res->id_products)->orderByDesc('id')->get();
        $id = $comment->id; 
        $name = $comment->name;
        return response([
            'id'=>$id,
            'name'=>$name,
            'comments' => $comments
        ]);
    }
    public function paginateCmt($page,$id){
        $sum_papers = comments::where('id_products',$id)->count();
        $per_page = 5;
        $pageCount = ceil($sum_papers / $per_page);
        $start = ($page - 1) * $per_page;
        $list_papers = comments::with('replies')->where('id_products',$id)->skip($start)->limit($per_page)->orderByDesc('id')->get();
        return response([
            'pageCount'=>$pageCount,
            'list_papers'=>$list_papers,
            'per_page'=>$per_page,
            'page'=>$page,
        ]);
    }
    public function paginateDanhgia($page,$id){
        $sum_papers = danhgia::where('id_products',$id)->count();
        $per_page = 5;
        $pageCount = ceil($sum_papers / $per_page);
        $pageCount = (int)$pageCount;
        $start = ($page - 1) * $per_page;
        $list_papers = danhgia::with('reply_danhgia')->where('id_products',$id)->skip($start)->limit($per_page)->orderByDesc('id')->get();
        return response([
            'pageCount'=>$pageCount,
            'list_papers'=>$list_papers,
            'per_page'=>$per_page,
            'page'=>$page,
        ]);
    }
    public function getListComment()
    {
       $comment = comments::orderByDesc('id')->get();
       return response([
        'result'=>$comment
       ]); 
    }
     public function getmuahang($id)
    {
        $product = products::where('id',$id)->first();
        Cart::add(['id'=>$id,'name'=>$product->name,'price'=>$product->price,'qty'=>1,'options'=>['image'=>$product->image]]);
        $content=Cart::content();
        $cartcount = Cart::count();
        $cartcontent=Cart::content();
        return response([
            'cartcount'=>$cartcount,
            'content'=>$content
        ]);
    }
     public function getListCartNew()
    {
        $total = Cart::subtotal(0,",",".");
        $cartcontent = Cart::content();
        return response([
            'cartcontent'=>$cartcontent,
            'total'=>$total
        ]);
    }
    public function getUpdateCart($rowId , $qty,$id)
    {
        $error='';
        Cart::update($rowId, $qty);
        $products = products::find($id);
        foreach(Cart::content() as $row) {
            $products = products::find($id);
            if($row->qty > $products->soluong)
            {
                 $qtynew = ($row->qty) -1;
                 Cart::update($rowId, $qtynew);
                 $error = "Số lượng sản phẩm  $products->name còn lại dưới  $products->soluong sản phẩm.Mong quý khách thông cảm!!";

            }
        }
         $total = Cart::subtotal(0,",",".");
         $content = Cart::content();
         $countCart = Cart::count();
         return response([
            'content' => $content,
            'total'=> $total,
            'error'=> $error,
            'countCart'=> $countCart
        ], 200);
    }
    public function getdeletecart($rowId)
    {
        Cart::remove($rowId);
        $content=Cart::content();
        $total = Cart::subtotal(0,",",".");
        $countCart = Cart::count();
        return response([
            'content'=>$content,
            'total'=>$total,
            'countCart' => $countCart
        ]);
    }
    public function getsearchcompares($search)
    {
        $productscompare = products::where('name','like','%'.$search.'%')->get();
        return response([
            'productscompare' => $productscompare
        ]);
    }
}
