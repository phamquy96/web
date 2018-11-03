<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});
Route::get('/themcot1', function () {
	Schema::table('bill_details', function ($table) {
	    $table->integer('finance');
	    echo"xong";
	});
});
Route::get('/themcot2', function () {
	Schema::table('bills', function ($table) {
	    $table->integer('status');
	    echo"xong";
	});
});
Route::get('/themcot3', function () {
	Schema::table('customers', function ($table) {
	    $table->string('soluong')->default(0);
	    echo"xong";
	});
});
Route::get('/themcot4', function () {
	Schema::table('customers', function ($table) {
	    $table->string('phone')->default(0);
	    echo"xong";
	});
});

Route::get('/themcot5', function () {
	Schema::table('customers', function ($table) {
	    $table->string('gender')->default(0);
	    echo"xong";
	});
});
Route::get('/themcot6', function () {
	Schema::table('bills', function ($table) {
	    $table->integer('status')->default(0);
	    echo"xong";
	});
});

Route::get('/themcotok', function () {
	Schema::table('products', function ($table) {
	    $table->integer('importprices')->default(0);
	    echo"xong";
	});
});

Route::group(['prefix'=>'admin'],function(){
	Route::get('/pages','ProductsController@getListpages');
	Route::group(['prefix'=>'sales'],function(){
		Route::get('list','SalesController@getlist');

		Route::get('add','CatesController@getAdd');
		Route::post('add','CatesController@postAdd');

		Route::get('edit/{id}','CatesController@getEdit');
		Route::post('edit/{id}','CatesController@postEdit');

		Route::get('xoa/{id}','CatesController@getDelete');
	});	
	Route::group(['prefix'=>'orders'],function(){
		Route::get('list','SalesController@getlist');

		Route::get('add','CatesController@getAdd');
		Route::post('add','CatesController@postAdd');

		Route::get('edit/{id}','CatesController@getEdit');
		Route::post('postorders/{id}','OrderController@postorders');

		Route::get('deleteOrder/{id}','OrderController@getdeleteOrder');
		Route::get('deleteCustomer/{id}','OrderController@getdeleteCustomer');
		Route::get('searchdate/{dateStar}/{dateEnd}','OrderController@getsearchdate');
	});	
	Route::group(['prefix'=>'products'],function(){
		Route::get('choose/{choose}','ProductsController@getchoose');
		Route::get('list','SalesController@getlist');
		Route::get('editproducts/{id}','ProductsController@geteditProducts');
		Route::post('/postupdateproducts/{id}','ProductsController@postUpdateProducts');
		Route::get('add','ProductsController@getAdd');
		Route::post('add','ProductsController@postAdd');

		Route::get('edit/{id}','ProductsController@getEdit');
		Route::post('postorders/{id}','ProductsController@postorders');

		Route::get('deleteProducts/{id}','ProductsController@getDelete');
		Route::get('search/{search}','ProductsController@getsearch');
		Route::get('searchblank','ProductsController@getsearchblank');
		Route::get('sort/{sort}','ProductsController@getsort');
		Route::get('list','SalesController@getlist');

		Route::get('add','ProductsController@getAdd');
		Route::post('add','ProductsController@postAdd');

		Route::get('edit/{id}','ProductsController@getEdit');
		Route::post('postorders/{id}','ProductsController@postorders');

		Route::get('deleteProducts/{id}','ProductsController@getDelete');
	});
	Route::group(['prefix'=>'warehouse'],function(){
		Route::get('list','WarehouseProductsController@getlist');
		Route::get('edit/{id}','WarehouseProductsController@getEdit');

		Route::get('listwarehouse/{id}','WarehouseProductsController@getlistwarehouse');

		Route::get('add','WarehouseProductsController@getAdd');
		Route::post('add','WarehouseProductsController@postAdd');

		Route::get('edit/{id}','WarehouseProductsController@getEdit');
		Route::post('postorders/{id}','WarehouseProductsController@postorders');

		Route::get('deleteProducts/{id}','WarehouseProductsController@getDelete');
		Route::get('searchdate/{dateStar}/{dateEnd}','WarehouseProductsController@getsearchdate');
	});
	Route::group(['prefix'=>'sell'],function(){
		Route::get('list','SellController@getlist');

		Route::get('add','SellController@getlist@getAdd');
		Route::post('add','SellController@postAdd');

		Route::get('edit/{id}','SellController@getEdit');
		Route::post('postorders/{id}','SellController@postorders');

		Route::get('deleteProducts/{id}','SellController@getDelete');
		Route::get('searchdate/{dateStar}/{dateEnd}','SellController@getsearchdate');
	});
	Route::group(['prefix'=>'profit'],function(){
		Route::get('list','SellController@getlist');

		Route::get('add','SellController@getlist@getAdd');
		Route::post('add','SellController@postAdd');

		Route::get('edit/{id}','SellController@getEdit');
		Route::post('postorders/{id}','SellController@postorders');

		Route::get('deleteProducts/{id}','SellController@getDelete');
		Route::get('searchdate/{dateStarnew}/{dateEnd}','ProfitController@getsearchdate');
	});
	Route::group(['prefix'=>'invetory'],function(){
		Route::get('choose/{choose}','InventoryController@getchoose');

		Route::get('search/{search}','InventoryController@getsearch');
		Route::get('searchblank','InventoryController@getsearchblank');
		Route::get('sort/{sort}','InventoryController@getsort');
		Route::post('add','InventoryController@postAdd');

		Route::get('edit/{id}','InventoryController@getEdit');
		Route::post('postorders/{id}','InventoryController@postorders');

		Route::get('deleteProducts/{id}','InventoryController@getDelete');
		Route::get('searchdate/{dateStar}/{dateEnd}','InventoryController@getsearchdate');
	});
	Route::group(['prefix'=>'user'],function(){
		Route::get('listuser','AuthController@getlistuser');
		Route::post('editUser/{id}','AuthController@posteditUser');
		Route::get('search/{search}','AuthController@getsearch');
		Route::get('searchblank','AuthController@getsearchblank');
	});

});

Route::get('/getsearchcompare/{search}','PagesHomeController@getsearchcompares');
Route::get('/papersProducts/{page}','PagesHomeController@paginateProducts');
Route::get('/papersdanhgia/{page}/{id}','PagesHomeController@paginateDanhgia');
Route::get('/paperscmt/{page}/{id}','PagesHomeController@paginateCmt');
Route::get('/papers/{page}','ProductsController@paginateProducts');
Route::resource('/products', 'ProductController');

Route::get('/searchproducts/{search}','PagesHomeController@getsearchproducts');
Route::get('/getsubcates','SubcatesController@getCates'); 
Route::get('/searchany/{keyword}','PagesHomeController@getSearchany');
Route::get('/productshomepages','PagesHomeController@getProductsHome');
Route::get('/pageproducts','PagesHomeController@getProducts');

Route::get('/getlistorders','OrderController@getlistorders');
Route::get('/listphieuthu','OrderController@getlistphieuthu');

Route::get('/deletepayment','OrderController@getdeletepayment');
Route::get('/getlistinventory','OrderController@getlistinventory');
Route::get('/deletelisttrade/{id}','WarehouseProductsController@getdeletelisttrade');


Route::get('/getlistcustomer','OrderController@getlistcustomer');
Route::get('/searchdatephieuthu/{dateStar}/{dateEnd}','OrderController@getsearchdatephieuthu');

Route::get('/searchdatephieuchi/{dateStar}/{dateEnd}','OrderController@getsearchdatephieuchi');


Route::get('/detailproducts/{id}','PagesHomeController@getDetailProducts');

Route::get('/addsearchproducts/{search}','WarehouseProductsController@getaddsearchproducts');
Route::post('/postproductskho','WarehouseProductsController@postproductskho');


Route::get('/listtrade','WarehouseProductsController@getlisttrade');


Route::get('/productswarehouse','WarehouseProductsController@getproductswarehouse');


Route::get('/getcates','SubcatesController@getCates');
Route::get('/productsmain/{id}','PagesHomeController@getproductsmain');
Route::get('/addCart/{id}','PagesHomeController@getmuahang');
Route::get('/productSubcates/{id}','PagesHomeController@getproductSubcates');
Route::get('/deletecates/{id}','CatesController@getdeleteCates');
Route::get('/deletesubcates/{id}','SubcatesController@getdeleteSubcates');
Route::get('/listcomment','PagesHomeController@getListComment');
Route::get('/getlistcartnew','PagesHomeController@getListCartNew');
Route::get('/deletecart/{rowId}','PagesHomeController@getdeletecart');
Route::get('/logout','AuthController@getlogout');
Route::get('/getproducts','ProductsController@getListgetproducts');
Route::get('/UpdateCart/{rowId}/{qty}/{id}','PagesHomeController@getUpdateCart');

Route::get('/compareProducts/{id}/{in}','PagesHomeController@getcompareProducts');
Route::get('/addsosanh/{id}','PagesHomeController@getaddsosanh');
Route::get('/searchCompare/{keyword}','PagesHomeController@getsearchCompare');
Route::get('/searchPriceProducts/{value}','PagesHomeController@getsearchPriceProducts');
Route::get('/priceincrement/{keyword}','PagesHomeController@getpPriceIncrement');

Route::get('/pricedimished/{keyword}','PagesHomeController@getPriceDimished');

 
Route::post('/repycmt', 'PagesHomeController@postrepycmt');
Route::post('/login', 'AuthController@postlogin');
Route::post('/single-file', 'TestController@upload');
Route::post('/multiple-files', 'TestController@uploadmultiple');
Route::post('/postupdateproducts/{id}','ProductsController@postUpdateProducts');
Route::post('/addproducts','ProductsController@postAddProducts');
Route::post('/addcates','CatesController@postAddCates');
Route::post('/addUser','AuthController@postaddUser');
Route::post('/postcates/{id}','CatesController@postproducts');
Route::post('/addpostrating','PagesHomeController@postAddRating');
Route::post('/postcomment','PagesHomeController@postComment');
Route::post('/repycmtdanhgia','PagesHomeController@postrepycmtdanhgia');
Route::post('/addsubcates','SubcatesController@postAddSubCates');
Route::post('/postCart','OrderController@postcart'); 
Route::get('/xoakhoangoai',function(){
Schema::table('replies', function ($table) {
   $table->dropForeign(['id_news']);
});
	echo "them ok";
});

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');

