<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ProducerController;

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

//*************************************USER***********************************************//

//Home
Route::get('/', 'App\Http\Controllers\HomeController@index');

Route::get('/home', 'App\Http\Controllers\HomeController@index');

Route::get('/search', 'App\Http\Controllers\HomeController@search');

Route::get('/contact_us', 'App\Http\Controllers\HomeController@contact_us');

Route::get('/about_us', 'App\Http\Controllers\HomeController@about_us');

Route::get('/error_payment', 'App\Http\Controllers\HomeController@error_payment');

Route::get('/example', 'App\Http\Controllers\HomeController@example');

//user interface -> shopping cart

Route::get('/update_total', 'App\Http\Controllers\CartController@update_total');

Route::post('/add_cart_ajax', 'App\Http\Controllers\CartController@add_cart_ajax');

Route::get('/delete_cart/{session_id}', 'App\Http\Controllers\CartController@delete_cart');

Route::post('/del_cart', 'App\Http\Controllers\CartController@del_Cart');

Route::post('/update_cart', 'App\Http\Controllers\CartController@update_cart');

Route::get('/cart_shopping', 'App\Http\Controllers\CartController@cart_shopping');

Route::post('/apply_coupon', 'App\Http\Controllers\CartController@applyCoupon');

//user interface -> check out

Route::get('/check_out', 'App\Http\Controllers\CheckOutController@check_out');

Route::post('/shipping_add', 'App\Http\Controllers\CheckOutController@shipping_add');

Route::post('/save_check_out', 'App\Http\Controllers\CheckOutController@add_check_out');

Route::get('/complete_check_out', 'App\Http\Controllers\CheckOutController@complete_check_out');

Route::get('/vnpay_check_out', 'App\Http\Controllers\CheckOutController@vnpay_check_out');

//user interface -> payment

Route::post('/vnpay_payment', 'App\Http\Controllers\PaymentController@vnpay_payment');

Route::get('/vnpay_return', 'App\Http\Controllers\PaymentController@vnpay_return');

//user interface -> login/register/logout

Route::get('/register_home', 'App\Http\Controllers\UserManagement@user_register');

Route::get('/login_home', 'App\Http\Controllers\UserManagement@user_login');

Route::get('/logout_user', 'App\Http\Controllers\UserManagement@user_logout');

Route::post('/login', 'App\Http\Controllers\UserManagement@login');

Route::post('/register', 'App\Http\Controllers\UserManagement@register');

Route::get('/my_account', 'App\Http\Controllers\UserManagement@my_account');

Route::post('/change_password', 'App\Http\Controllers\UserManagement@change_password');

Route::post('/change_info', 'App\Http\Controllers\UserManagement@change_info');

Route::get('/show_address', 'App\Http\Controllers\UserManagement@show_address');

Route::post('/add_address', 'App\Http\Controllers\UserManagement@add_address');

Route::post('/address_detail', 'App\Http\Controllers\UserManagement@address_detail');

Route::post('/update_address', 'App\Http\Controllers\UserManagement@update_address');

Route::post('/delete_address', 'App\Http\Controllers\UserManagement@delete_address');

//user interface -> category page

Route::get('/category_home/{id_cate}', 'App\Http\Controllers\CategoryManagement@show_category_home');

Route::get('/list/{id_list}', 'App\Http\Controllers\CategoryManagement@show_list');

Route::get('/show_catechild/{id}', 'App\Http\Controllers\CateChildController@show_catechild');

//user interface -> product details page

Route::get('/product_details/{id}', 'App\Http\Controllers\ProductController@product_detail');

Route::get('/product_discount', 'App\Http\Controllers\ProductController@product_discount');

//user interface -> favourite product page

Route::post('/favourite_product', 'App\Http\Controllers\ProductController@favourite_product');

Route::get('/wish_list', 'App\Http\Controllers\ProductController@wish_list');

Route::post('/delete_wishlist', 'App\Http\Controllers\ProductController@delete_wishlist');

//user interface -> show order 

Route::get('/show_order', 'App\Http\Controllers\OrderManagement@show_order');

Route::get('/order_detail/{id_order}', 'App\Http\Controllers\OrderManagement@order_detail');

Route::post('/update_order', 'App\Http\Controllers\OrderManagement@update_order');

//user interface -> comment

Route::post('/load_comment', 'App\Http\Controllers\CommentController@load_comment');

Route::post('/add_comment', 'App\Http\Controllers\CommentController@add_comment');

Route::get('/rating/{id}', 'App\Http\Controllers\CommentController@rating_product');


//user interface -> delivery

Route::post('/select_delivery', 'App\Http\Controllers\DeliveryController@select_delivery');

Route::post('/select_update_delivery', 'App\Http\Controllers\DeliveryController@select_update_delivery');

Route::post('/get_delivery', 'App\Http\Controllers\DeliveryController@get_delivery');


//*************************************ADMIN***********************************************//

//Home
Route::get('/admin', 'App\Http\Controllers\AdminController@index');

Route::get('/dashboard', 'App\Http\Controllers\AdminController@dashboard');

Route::post('/admin_dashboard', 'App\Http\Controllers\AdminController@admin_dashboard');

Route::get('/logout', 'App\Http\Controllers\AdminController@Logout');

Route::get('/404', 'App\Http\Controllers\AdminController@error_page');

//Đếm số order
Route::get('/count_order', 'App\Http\Controllers\OrderManagement@count_order');

//Thống kê sản phẩm bán chạy
Route::post('/product_bestsell', 'App\Http\Controllers\ProductController@best_sell');

//admin interface -> user management

Route::get('/user', 'App\Http\Controllers\UserManagement@user');

Route::get('/password', 'App\Http\Controllers\UserManagement@password');

Route::post('/change_pass', 'App\Http\Controllers\UserManagement@change_pass');

Route::post('/update_user', 'App\Http\Controllers\UserManagement@update_user');



//Chỉ Staff và Admin mới truy cập
Route::group(['middleware' => 'roles'], function(){

	//admin interface -> order management

	Route::get('/order_management', 'App\Http\Controllers\OrderManagement@order_management');

	Route::get('/view_order/{SoDonDH}', 'App\Http\Controllers\OrderManagement@view_order');

	Route::post('/update_status', 'App\Http\Controllers\OrderManagement@update_status');

	Route::get('/print_order/{checkout_code}', 'App\Http\Controllers\OrderManagement@print_order');

	Route::post('/choose_shipper', 'App\Http\Controllers\OrderManagement@choose_shipper');

	//Chỉ được xem các sản phẩm
	Route::get('/product_management', 'App\Http\Controllers\ProductController@product_management');

});


//Quyền của admin
Route::group(['middleware' => 'admin_role'], function(){

	//admin interface -> Staff

	Route::get('/staff_management', 'App\Http\Controllers\StaffController@show_staff');

	Route::get('/add_staff', 'App\Http\Controllers\StaffController@add_staff');

	Route::post('/save_staff', 'App\Http\Controllers\StaffController@save_staff');

	Route::get('/delete_staff/{id}', 'App\Http\Controllers\StaffController@delete_staff');

	Route::get('/unblock_staff/{id}', 'App\Http\Controllers\StaffController@unblock_staff');

	//admin interface -> role

	Route::get('/role_management', 'App\Http\Controllers\RoleController@role_management');

	Route::post('/assign_role', 'App\Http\Controllers\RoleController@assign_role');

	//admin interface -> category management

	Route::get('/category_management', 'App\Http\Controllers\CategoryManagement@category_management');

	Route::get('/add_category', 'App\Http\Controllers\CategoryManagement@add');

	Route::get('/update_category/{category_product_id}','App\Http\Controllers\CategoryManagement@update_category');

	Route::get('/delete_category/{category_product_id}', 'App\Http\Controllers\CategoryManagement@delete');

	Route::post('/save_category','App\Http\Controllers\CategoryManagement@save_category');

	Route::post('/edit_category/{category_product_id}','App\Http\Controllers\CategoryManagement@edit_category');

	//admin interface -> category child management

	Route::get('/catechild_management', 'App\Http\Controllers\CateChildController@catechild_management');

	Route::get('/add_catechild', 'App\Http\Controllers\CateChildController@add');

	Route::get('/update_catechild/{id}','App\Http\Controllers\CateChildController@update_catechild');

	Route::get('/delete_catechild/{id}', 'App\Http\Controllers\CateChildController@delete');

	Route::post('/save_catechild','App\Http\Controllers\CateChildController@save_catechild');

	Route::post('/edit_catechild/{id}','App\Http\Controllers\CateChildController@edit_catechild');

	

	//admin interface -> product management

	Route::get('/add_product', 'App\Http\Controllers\ProductController@add');

	Route::get('/update_product/{id}','App\Http\Controllers\ProductController@update_product');

	Route::get('/delete_product/{id}/{hinhanh}', 'App\Http\Controllers\ProductController@delete');

	Route::post('/save_product', 'App\Http\Controllers\ProductController@save_product');

	Route::post('/edit_product/{id}', 'App\Http\Controllers\ProductController@edit_product');

	//admin interface -> images product

	Route::get('/images_product', 'App\Http\Controllers\ProductController@images_product');

	Route::get('/delete_images/{id}', 'App\Http\Controllers\ProductController@delete_images');


	//admin interface -> comment

	Route::get('/show_comment', 'App\Http\Controllers\CommentController@show_comment');

	Route::post('/status_comment', 'App\Http\Controllers\CommentController@status_comment');

	//admin interface -> statistic

	Route::get('/show_statistic', 'App\Http\Controllers\RevenueController@show_statistical');

	Route::get('/quantity_statistic', 'App\Http\Controllers\RevenueController@quantity_statistic');

	// Route::get('/price_statistic', 'App\Http\Controllers\RevenueController@price_statistic');

	Route::post('/load_statistic', 'App\Http\Controllers\RevenueController@load_statistic');

	Route::post('/search_statistic', 'App\Http\Controllers\RevenueController@search_statistic');

	//admin interface -> coupon
	Route::resource('coupon', CouponController::class );

	//admin interface -> producer
	Route::resource('producer', ProducerController::class );

	//admin interface -> customer

	Route::get('/show_user', 'App\Http\Controllers\UserManagement@show_user');

	Route::post('/status_user', 'App\Http\Controllers\UserManagement@status_user');

	// Route::get('/unblock_user/{id}', 'App\Http\Controllers\UserManagement@unblock_staff');

});

//Quyền của Stock và Admin
Route::group(['middleware' => 'stock_role'], function(){
	//admin interface -> receipt

	Route::get('/add_receipt', 'App\Http\Controllers\ReceiptController@show_add');

	Route::get('/edit_receipt/{id}', 'App\Http\Controllers\ReceiptController@edit');

	Route::post('/save_receipt', 'App\Http\Controllers\ReceiptController@add');

	Route::post('/update_receipt', 'App\Http\Controllers\ReceiptController@update');

	Route::get('/show_receipt', 'App\Http\Controllers\ReceiptController@show_all');

	Route::post('/infor_receipt', 'App\Http\Controllers\ReceiptController@show');

	Route::post('/export-csv','App\Http\Controllers\ReceiptController@export');

	Route::post('/import-csv','App\Http\Controllers\ReceiptController@import');

	Route::get('/print_receipt/{code}', 'App\Http\Controllers\ReceiptController@print');
});

//*************************************SHIPPER***********************************************//

//Shipper -> home

Route::get('/dashboard_shipper', 'App\Http\Controllers\ShipperController@dashboard');

Route::get('/register_shipper', 'App\Http\Controllers\ShipperController@register');

Route::get('/shipper', 'App\Http\Controllers\ShipperController@index');

Route::post('/login_shipper', 'App\Http\Controllers\ShipperController@login');

Route::post('/add_shipper', 'App\Http\Controllers\ShipperController@add');

Route::get('/logout_shipper', 'App\Http\Controllers\ShipperController@logout');

Route::get('/shipper_order', 'App\Http\Controllers\ShipperController@order_process');

Route::get('/shipper_infor', 'App\Http\Controllers\ShipperController@infor');

Route::get('/shipper_noti', 'App\Http\Controllers\ShipperController@notification');

Route::get('/shipper_success', 'App\Http\Controllers\ShipperController@order_success');

Route::post('/update_status_order', 'App\Http\Controllers\ShipperController@update');

Route::post('/complete_status_order', 'App\Http\Controllers\ShipperController@complete');

Route::post('/save_shipper_infor', 'App\Http\Controllers\ShipperController@update_shipper');


