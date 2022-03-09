<?php

use Illuminate\Support\Facades\Route;

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

//USER INTERFACE

//Home
Route::get('/', 'App\Http\Controllers\HomeController@index');

Route::get('/home', 'App\Http\Controllers\HomeController@index');

Route::get('/search', 'App\Http\Controllers\HomeController@search');

Route::get('/contact_us', 'App\Http\Controllers\HomeController@contact_us');

Route::get('/about_us', 'App\Http\Controllers\HomeController@about_us');

//user interface -> shopping cart

Route::get('/update_total', 'App\Http\Controllers\CartController@update_total');

Route::post('/add_cart_ajax', 'App\Http\Controllers\CartController@add_cart_ajax');

Route::get('/delete_cart/{session_id}', 'App\Http\Controllers\CartController@delete_cart');

Route::post('/del_cart', 'App\Http\Controllers\CartController@del_Cart');

Route::post('/update_cart', 'App\Http\Controllers\CartController@update_cart');

Route::get('/cart_shopping', 'App\Http\Controllers\CartController@cart_shopping');

//user interface -> check out

Route::get('/check_out', 'App\Http\Controllers\CheckOutController@check_out');

Route::post('/shipping_add', 'App\Http\Controllers\CheckOutController@shipping_add');

Route::post('/save_check_out', 'App\Http\Controllers\CheckOutController@save_check_out');

Route::get('/complete_check_out', 'App\Http\Controllers\CheckOutController@complete_check_out');

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

//user interface -> category page

Route::get('/category_home/{id_cate}', 'App\Http\Controllers\CategoryManagement@show_category_home');

Route::get('/list/{id_list}', 'App\Http\Controllers\CategoryManagement@show_list');

Route::get('/show_catechild/{id}', 'App\Http\Controllers\CateChildController@show_catechild');

//user interface -> product details page

Route::get('/product_details/{id}', 'App\Http\Controllers\ProductController@product_detail');

Route::post('/quickview', 'App\Http\Controllers\ProductController@quick_view');

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


//ADMIN INTERFACE

//Home
Route::get('/admin', 'App\Http\Controllers\AdminController@index');

Route::get('/dashboard', 'App\Http\Controllers\AdminController@dashboard');

Route::post('/admin_dashboard', 'App\Http\Controllers\AdminController@admin_dashboard');

Route::get('/logout', 'App\Http\Controllers\AdminController@Logout');

Route::get('/404', 'App\Http\Controllers\AdminController@error_page');

//admin interface -> user management

Route::get('/user', 'App\Http\Controllers\UserManagement@user');

Route::get('/password', 'App\Http\Controllers\UserManagement@password');

Route::post('/change_pass', 'App\Http\Controllers\UserManagement@change_pass');

Route::post('/update_user', 'App\Http\Controllers\UserManagement@update_user');

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

Route::get('/product_management', 'App\Http\Controllers\ProductController@product_management');

Route::get('/update_product/{id}','App\Http\Controllers\ProductController@update_product');

Route::get('/delete_product/{id}/{hinhanh}', 'App\Http\Controllers\ProductController@delete');

Route::post('/save_product', 'App\Http\Controllers\ProductController@save_product');

Route::post('/edit_product/{id}', 'App\Http\Controllers\ProductController@edit_product');

Route::post('/product_bestsell', 'App\Http\Controllers\ProductController@best_sell');

//admin interface -> images product

Route::get('/images_product', 'App\Http\Controllers\ProductController@images_product');

Route::get('/delete_images/{id}', 'App\Http\Controllers\ProductController@delete_images');

//admin interface -> order management

Route::get('/order_management', 'App\Http\Controllers\OrderManagement@order_management');

Route::get('/view_order/{SoDonDH}', 'App\Http\Controllers\OrderManagement@view_order');

Route::post('/update_status', 'App\Http\Controllers\OrderManagement@update_status');

Route::get('/print_order/{checkout_code}', 'App\Http\Controllers\OrderManagement@print_order');

Route::get('/count_order', 'App\Http\Controllers\OrderManagement@count_order');

//admin interface -> receipt

Route::get('/add_receipt', 'App\Http\Controllers\ReceiptController@show_add');

Route::post('/save_receipt', 'App\Http\Controllers\ReceiptController@add');

Route::get('/show_receipt', 'App\Http\Controllers\ReceiptController@show_all');

//admin interface -> Staff

Route::get('/staff_management', 'App\Http\Controllers\StaffController@show_staff');

Route::get('/add_staff', 'App\Http\Controllers\StaffController@add_staff');

Route::post('/save_staff', 'App\Http\Controllers\StaffController@save_staff');

Route::get('/delete_staff/{id}', 'App\Http\Controllers\StaffController@delete_staff');

Route::get('/unblock_staff/{id}', 'App\Http\Controllers\StaffController@unblock_staff');

//admin interface -> comment

Route::get('/show_comment', 'App\Http\Controllers\CommentController@show_comment');

//admin interface -> statistic

Route::get('/show_statistic', 'App\Http\Controllers\RevenueController@show_statistical');

Route::post('/load_statistic', 'App\Http\Controllers\RevenueController@load_statistic');

Route::post('/search_statistic', 'App\Http\Controllers\RevenueController@search_statistic');