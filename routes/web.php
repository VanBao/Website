<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/
Route::group(['prefix' => 'quan-tri','middleware'=>'checkAdmin'], function () {
	Route::get("", ["as"=>"adminHome", "uses"=>"PageController@showAdminHome"]);
	Route::group(['prefix' => 'loai-san-pham'], function () {
		Route::get('danh-sach', ['as'=>'categoryList', 'uses'=>'CategoryController@index']);
		Route::get('them', ['as'=> 'categoryAdding', 'uses'=>'CategoryController@create']);
		Route::post('them', ['uses'=>'CategoryController@store']);
		Route::get('xoa/{id}', ['as'=>'categoryDeleting', 'uses'=>'CategoryController@delete']);
		Route::get('cap-nhat/{id}', ['as'=>'categoryUpdate', 'uses'=>'CategoryController@edit']);
		Route::post('cap-nhat', ['as'=>'categoryUpdate2', 'uses'=>'CategoryController@update']);
	});
	Route::group(['prefix' => 'san-pham'], function () {
		Route::get('danh-sach', ['as'=>'productList', 'uses'=>"ProductController@index"]);
		Route::get('xoa/{id}',['as'=>'productDeleting','uses'=>'ProductController@delete']);
		Route::get('them', ['as'=> 'productAdding', 'uses'=>'ProductController@create']);
		Route::post('them', ['uses'=>'ProductController@store']);
		Route::get('cap-nhat/{id}', ['as'=>'productUpdate', 'uses'=>'ProductController@edit']);
		Route::post('cap-nhat', ['as'=>'productUpdate2','uses'=>'ProductController@update']);
		Route::get('cap-nhat-trang-thai', ['as'=>'updateStatusProduct', 'uses'=>'ProductController@updateStatus']);
	});
	Route::group(['prefix' => 'don-dat-hang'], function () {

		Route::get('danh-sach', ['as'=>'billList', 'uses'=>'BillController@index']);
		Route::get('pdf/{id}',['as'=>'pdf', 'uses'=>'BillController@toPDF']);
		Route::get('chi-tiet/{id}', ['as'=>'billDetail', 'uses'=>'BillDetailController@detail']);
		Route::get('xoa', ['as'=>'billDeleting','uses'=>'BillController@delete']);
		Route::get('danh-sach-chua-xu-ly', ['as'=>'unprocessedBillList', 'uses'=>'BillController@showUnprocessedList']);
		Route::get('cap-nhat-trang-thai', ['as'=>'updateStatusBill', 'uses'=>'BillController@updateStatus']);
	});

	Route::group(['middleware'=>'checkAdmin2'], function () {

		Route::get('danh-sach-nhan-vien', ['as'=>'listStaff', 'uses'=>'AdminController@index']);

		Route::get('xoa-nhan-vien/{id}', ['as'=>'deleteStaff', 'uses'=>'AdminController@delete']);

		Route::get('them-nhan-vien',['as'=>'addStaff', 'uses'=>'AdminController@create']);

		Route::post('them-nhan-vien',['uses'=>'AdminController@store']);
		Route::get('phan-quyen/{id}', ['as'=>'privilege', 'uses'=>'AdminController@showPrivilege']);
		Route::post('phan-quyen', ['as'=>'privilege2', 'uses'=>'AdminController@privilege']);
	});
	Route::group(['prefix' => 'slide'], function () {
		Route::get('danh-sach', ['as'=>'slideList', 'uses'=>'SlideController@index']);
		Route::get('them', ['as'=> 'slideAdding', 'uses'=>'SlideController@create']);
		Route::post('them', ['uses'=>'SlideController@store']);
		Route::get('xoa/{id}',['as'=>'slideDeleting','uses'=>'SlideController@delete']);
		Route::get('cap-nhat/{id}', ['as'=>'slideUpdate', 'uses'=>'SlideController@edit']);
		Route::post('cap-nhat', ['as'=>'slideUpdate2', 'uses'=>'SlideController@update']);
		Route::get('cap-nhat-trang-thai', ['as'=>'updateStatusSlide', 'uses'=>'SlideController@updateStatus']);
	});
	Route::group(['prefix' => 'tin-nhan'], function () {
		Route::get('danh-sach', ['as'=>'contactList', 'uses'=>'ContactController@index']);
		Route::get('xoa/{id}',['as'=>'contactDeleting','uses'=>'ContactController@delete']);
		Route::get('tra-loi/{id}',['as'=>'answer', 'uses'=>'ContactController@showAnswerForm']);
		Route::post('tra-loi',['as'=>'answer2', 'uses'=>'ContactController@answer']);
		Route::get('danh-sach-chua-tra-loi',['as'=>'unreadList','uses'=>'ContactController@showUnreadList']);
	});
	Route::get('tai-khoan', ['as'=>'accountAdmin', 'uses'=>'AdminController@showAccount']);
	Route::post('tai-khoan', ['uses'=>'AdminController@updateAccount']);
	Route::get('thay-doi-mat-khau', ['as'=>'changePasswordAdmin', 'uses'=>'AdminController@showChangingPasswordForm']);
	Route::post('thay-doi-mat-khau', ['uses'=>'AdminController@changePassword']);
});
Route::get('quan-tri/dang-nhap', ['as'=>'loginAdmin', 'uses'=>'AdminController@showLogin']);
Route::post('quan-tri/dang-nhap', ['uses'=>'AdminController@login']);
Route::get('quan-tri/dang-xuat', ['as'=>'logoutAdmin', 'uses'=>'AdminController@logout']);
Route::get('',["as"=>"home", "uses"=>"PageController@showHome"]);
Route::get('lien-he', ["as"=>"contact", "uses"=>"PageController@showContact"]);
Route::post('lien-he', ["uses"=>"ContactController@save"]);
Route::get('gio-hang',["as"=>"cart", "uses"=>"PageController@showCart"]);
Route::get('gioi-thieu', ["as"=>"about", "uses"=>"PageController@showAbout"]);
Route::get('dang-nhap', ["as"=>"login", "uses"=>"PageController@showLogin"]);
Route::post("dang-nhap", ["uses"=>"UserController@login"]);
Route::get('dang-xuat', ["as"=>'logout', "uses"=>"UserController@logout"]);
Route::get('thay-doi-thong-tin', ["middleware"=>"checkLogin","as"=>"changeInformation", "uses"=>"PageController@showChangeInformation"]);
Route::post('thay-doi-thong-tin', ["uses"=>"UserController@changeInformation"]);
Route::get('khoi-phuc-mat-khau', ["middleware"=>"checkResetPassword","as"=>"resetPassword", "uses"=>"PageController@showResetPassword"]);
Route::post('khoi-phuc-mat-khau',["uses"=>"UserController@resetPassword"]);
Route::get('thay-doi-mat-khau', ["middleware"=>"checkLogin","as"=>"changePassword", "uses"=>"PageController@showChangePassword"]);
Route::post('thay-doi-mat-khau',["uses"=>"UserController@changePassword"]);
Route::get('dang-ky', ['as'=>'register', 'uses'=>'PageController@showRegister']);
Route::post('dang-ky', ["uses"=>"UserController@register"]);
Route::get('san-pham/{name}', ['as'=>'product-detail', 'uses'=>'PageController@showProductDetail']);
Route::get('loai-san-pham/{name}/{page?}', ['as'=>'category', 'uses'=>'PageController@showCategory']);
Route::get('mua-san-pham/{id}/{quantity}', ['as'=>'purchase', 'uses'=>'PageController@purchase']);
Route::get('tai-khoan', ['middleware'=>'checkLogin','as'=>'account', 'uses'=>'PageController@showAccount']);
Route::get('cap-nhat-gio-hang/{id}/{quantity}', ['as'=>'update_cart', 'uses' => "PageController@updateCart"]);
Route::get('xoa-sp-gio-hang/{id}', ['as'=>'delete_product_cart', 'uses' => "PageController@deleteProductInCart"]);
Route::post('dat-hang', ['middleware'=>'checkOrder', 'as'=>'order', 'uses'=>'PageController@order']);
Route::get('kich-hoat-tai-khoan/{email}',['as'=>'activate', 'uses'=>'UserController@activate']);
Route::get('tim-kiem/{page?}', ['as'=>'search', 'uses'=>'PageController@search']);

Route::get('cap-nhat-danh-gia', ['as'=>'updateVote', 'uses'=>'PageController@updateVote']);
Route::get('Loi404', ['as'=>'404NotFound', 'uses'=>'PageController@show404NotFound']);
Route::get('/{type}/{page}', ['as'=>'loadingDataHome', 'uses'=>'PageController@loadDataHome']);
