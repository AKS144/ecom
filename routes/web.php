  <?php

use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//return view('layouts');
//});

//frontend
Route::get('/','HomeController@index');
//endfrontend

// product_by_category n manufacture and cart
Route::get('/product_by_category/{category_id}','HomeController@show_product_by_category');
Route::get('/product_by_manufacture/{manufacture_id}','HomeController@show_product_by_manufacture');
Route::get('/view_product/{product_id}','HomeController@product_details_by_id');

//cart routes
Route::post('/add-to-cart','CartController@add_to_cart');
Route::get('/show-cart','CartController@show_cart');
Route::get('/delete-to-cart/{rowId}','CartController@delete_to_cart');
Route::post('/update-cart','CartController@update_cart');


//checkout routes........................
Route::get('/login-check','CheckoutController@login_check');
Route::post('/customer-registration','CheckoutController@customer_registration');
Route::get('/checkout','CheckoutController@checkout');
Route::post('/save-shipping-details','CheckoutController@save_shipping_details');

//customer login.........................
Route::post('/customer-login','CheckoutController@customer_login');
Route::get('/customer-logout','CheckoutController@customer_logout');

//payment
Route::get('/payment','CheckoutController@payment');
Route::post('/order-placed','CheckoutController@order_place');

//manage order
Route::get('/manage-order','CheckoutController@manage_order');
Route::get('/view-order/{order_id}','CheckoutController@view_order');


//backend
//admin
Route::get('/logout','SuperAdminController@logout');
Route::get('/admin','AdminController@index');
Route::get('/dashboard','SuperAdminController@index');
Route::post('/admin-dashboard','AdminController@dashboard');


//category related route
Route::get('/add-category','CategoryController@index');
Route::get('/all-category','CategoryController@all_category');
Route::post('/save-category','CategoryController@save_category');
Route::get('/edit-category/{category_id}','CategoryController@edit_category');
Route::post('/update-category/{category_id}','CategoryController@update_category');
Route::get('/delete-category/{category_id}','CategoryController@delete_category');
Route::get('/unactive-category/{category_id}','CategoryController@unactive_category');
Route::get('/active-category/{category_id}','CategoryController@active_category');


//manufacture or brands routes are here
Route::get('/add-manufacture','ManufactureController@index');
Route::get('/all-manufacture','ManufactureController@all_manufacture');
Route::post('/save-manufacture','ManufactureController@save_manufacture');
Route::get('/edit-manufacture/{manufacture_id}','ManufactureController@edit_manufacture');
Route::post('/update-manufacture/{manufacture_id}','ManufactureController@update_manufacture');
Route::get('/delete-manufacture/{manufacture_id}','ManufactureController@delete_manufacture');
Route::get('/unactive-manufacture/{manufacture_id}','ManufactureController@unactive_manufacture');
Route::get('/active-manufacture/{manufacture_id}','ManufactureController@active_manufacture');



//products related route
Route::get('/add-product','ProductController@index');
Route::post('/save-product','ProductController@save_product');
Route::get('/all-product','ProductController@all_product');
Route::get('/unactive-product/{products_id}','ProductController@unactive_product');
Route::get('/active-product/{products_id}','ProductController@active_product');
Route::get('/delete-product/{products_id}','ProductController@delete_product');
Route::get('/edit-product/{products_id}','ProductController@edit_product');
Route::post('/update-product/{products_id}','ProductController@update_product');

//slider routes are Here
Route::get('/add-slider','SliderController@index');
Route::post('/save-slider','SliderController@add_slider');
Route::get('/all-slider','SliderController@all_slider');
Route::get('/unactive-slider/{id}','SliderController@unactive_slider');
Route::get('/active-slider/{id}','SliderController@active_slider');
Route::get('/delete-slider/{id}','SliderController@delete_slider');


//product by category
