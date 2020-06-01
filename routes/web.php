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

//frontend site..............................
Route::get('/', 'HomeController@index' );

Route::get('/customer_logout', 'HomeController@customer_logout' );

Route::post('/customer_login', 'HomeController@customer_login' );








//backend site...............................
Route::get('/login', 'AdminController@index' );

Route::get('/dashboard','SuperAdminController@index');

Route::post('/admin-dashboard','AdminController@dashboard');

Route::get('/logout','SuperAdminController@logout');

Route::get('/manage_order', 'AdminController@manage_order' );

Route::get('/active_order/{order_id}', 'AdminController@active_order' );

Route::get('/unactive_order/{order_id}', 'AdminController@unactive_order' );

Route::get('/delete_order/{order_id}', 'AdminController@delete_order' );

Route::get('/view_order/{order_id}', 'AdminController@view_order' );
//...........................................



//Category related routes

Route::get('/add_category','CategoryController@index');

Route::get('/all_category','CategoryController@all_category');

Route::post('/save_category','CategoryController@save_category');

Route::get('/unactive_category/{category_id}','CategoryController@unactive_category');

Route::get('/active_category/{category_id}','CategoryController@active_category');

Route::get('/edit_category/{category_id}','CategoryController@edit_category');

Route::post('/update_category/{category_id}','CategoryController@update_category');

Route::get('/delete_category/{category_id}','CategoryController@delete_category');



//admin related routes

Route::get('/all_admin','AdminController@all_admin');

Route::get('/add_admin','AdminController@add_admin');

Route::post('/save_admin','AdminController@save_admin');

Route::get('/unactive_admin/{admin_id}','AdminController@unactive_admin');

Route::get('/active_admin/{admin_id}','AdminController@active_admin');

Route::get('/edit_admin/{admin_id}','AdminController@edit_admin');

Route::post('/update_admin/{admin_id}','AdminController@update_admin');

Route::get('/delete_admin/{admin_id}','AdminController@delete_admin');





//Brands related routes
Route::get('/add_brand','BrandController@index');

Route::post('/save_brand','BrandController@save_brand');

Route::get('/all_brands','BrandController@all_brand');

Route::get('/unactive_brand/{brand_id}','BrandController@unactive_brand');

Route::get('/active_brand/{brand_id}','BrandController@active_brand');

Route::get('/edit_brand/{brand_id}','BrandController@edit_brand');

Route::post('/update_brand/{brand_id}','BrandController@update_brand');

Route::get('/delete_brand/{brand_id}','BrandController@delete_brand');


//Products related routes
Route::get('/add_product','ProductController@index');

Route::post('/save_product','ProductController@save_product');

Route::get('/all_product','ProductController@all_product');

Route::get('/unactive_product/{product_id}','ProductController@unactive_product');

Route::get('/active_product/{product_id}','ProductController@active_product');

Route::get('/edit_product/{product_id}','ProductController@edit_product');

Route::post('/update_product/{product_id}','ProductController@update_product');

Route::get('/delete_product/{product_id}','ProductController@delete_product');


//Slider related routes
Route::get('/add_slider','SliderController@index');

Route::get('/all_slider','SliderController@all_slider');

Route::post('/save_slider','SliderController@save_slider');

Route::get('/unactive_slider/{slider_id}','SliderController@unactive_slider');

Route::get('/active_slider/{slider_id}','SliderController@active_slider');

Route::get('/delete_slider/{slider_id}','SliderController@delete_slider');



//show category wise product

Route::get('/product_by_category/{category_id}','HomeController@show_product_by_category');


//show brand wise product

Route::get('/product_by_brand/{brand_id}','HomeController@show_product_by_brand');

//view product

Route::get('/view_product/{product_id}','HomeController@view_product');


// cart

Route::post('/add_to_cart','CartController@add_to_cart');

Route::get('/show_cart','CartController@show_cart');

Route::get('/delete_from_cart/{id}','CartController@delete_from_cart');

Route::get('/update_plus/{id}','CartController@update_plus');

Route::get('/update_minus/{id}','CartController@update_minus');

//user login check

Route::get('/login_check','CheckoutController@login_check');

//user reg

Route::post('/customer_reg','CheckoutController@customer_reg');

//checkout

Route::get('/checkout','CheckoutController@checkout');

Route::post('/save_shipping_details','CheckoutController@save_shipping_details');

Route::get('/payment','CheckoutController@payment');

Route::post('/order_place','CheckoutController@order_place');






















