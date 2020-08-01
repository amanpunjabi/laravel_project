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

// Route::get('/','Frontend\\FrontendController@index')->name('homepage');
 

Auth::routes();

Route::get('/home',function()
{
	return view('auth.login');
})->name('home');

Route::get('/contact',function()
{
	return view('frontend.contact');
})->name('contact');
Route::get('/login',function()
{
	return view('frontend.login');
})->name('login');

Route::namespace('Admin')->prefix('admin')->middleware('auth')->name('admin.')->group(function(){
	Route::resource('/users','UsersController');
	// Route::delete('users/{id}', 'UserController@destroy')->name('users.destroy');
	//Route::delete('/users/{id}','UsersController@destroy');
	// Route::resource('admin/users', 'Admin\\UsersController');
	Route::get('/dashboard',function(){
		return view('content');
	})->name('dashboard');
	Route::get('/configuration','ConfigurationController@index')->name('configuration.index');
	Route::post('/configuration','ConfigurationController@store')->name('configuration.update');
	Route::resource('/category', 'CategoryController');
	Route::resource('/banners', 'BannersController');
	Route::resource('/brands', 'BrandsController');
	Route::resource('/product-attributes', 'ProductAttributesController');

	Route::resource('/product-attribute-values', 'ProductAttributeValuesController');
	Route::resource('products', 'ProductsController');
	Route::get('products/{product}/images', 'ProductsController@images')->name('products.images');

	Route::patch('products/{product}/images', 'ProductsController@save_image')->name('products.images.save');
	
	Route::delete('products/{image}/images', 'ProductsController@remove_image')->name('products.images.delete');
	Route::resource('coupons', 'CouponsController');

	Route::get('attribute_list/{id}', 'ProductsController@product_attribute')->name('products.attribute_list');

	Route::get('attribute_values', 'ProductsController@get_attribute_value')->name('products.attribute_value');

	Route::post('assingvalues/{id}', 'ProductsController@create_variant')->name('products.assign_values');

	Route::resource('contact','ContactUsController');
	Route::resource('orders','OrderController');
	Route::get('/printOrder/{id}','OrderController@printOrder')->name('orders.print');
	Route::resource('cms','CmsController');
	Route::get('report/','ReportController@salesReport')->name('report.sales');
	Route::get('report/user','ReportController@userReport')->name('report.user');
	Route::get('report/coupon','ReportController@couponReport')->name('report.coupon');
	Route::resource('email','EmailTemplatesController'); 

	Route::delete('/remove-variant/{id}','ProductsController@remove_variant')->name('remove-variant');
	Route::get('/user-orders/{id}','ReportController@userOrders')->name('user.orders');

});

Route::post('contact','Admin\\ContactUsController@store')->name('contact.store');
 


 //cart routes
Route::namespace('Frontend')->group(function(){

Route::get('/', 'CartController@shop')->name('homepage');
Route::get('/cart', 'CartController@cart')->name('cart.index');
Route::post('/add', 'CartController@add')->name('cart.store');
Route::post('/update', 'CartController@update')->name('cart.update');
Route::post('/remove', 'CartController@remove')->name('cart.remove');
Route::post('/clear', 'CartController@clear')->name('cart.clear');
Route::get('/product-detail/{id}/{value?}','FrontendController@product_detail')->name('product_detail');
//category-wise product list
Route::get('product-list/{id?}','FrontendController@ProductByCategory')->name('category.product');
Route::post('product-list/','FrontendController@ProductBySearch')->name('search.product');
Route::get('category/content/{id}','FrontendController@categoryContent')->name('categoryContent');
});





    Route::namespace('Frontend')->middleware('auth')->group(function(){
	
	Route::get('/wishlist/{id}','FrontendController@add_wishlist')->name('add_wishlist');

	Route::get('/wishlist','FrontendController@wishlist')->name('wishlist');

	Route::get('/wishlist/delete/{id}','FrontendController@remove_wishlist')->name('remove_wishlist');
	Route::get('/profile','FrontendController@profile')->name('profile');
	Route::post('/profile','FrontendController@profile_update')->name('profile.update');
	Route::post('/review-payment','CheckoutController@ship_address')->name('shipping.address');
	Route::get('/checkout-address','CheckoutController@checkoutaddress');

	Route::get('/my-orders/','FrontendController@myOrders');
	Route::get('/view-order/{id}','FrontendController@viewOrder');
	
	Route::post('/checkout/order','CheckoutController@placeOrder')->name('checkout.place.order');
	Route::post('coupon','FrontendController@storeCoupon')->name('storecoupon');
	Route::delete('coupon/destroy','FrontendController@destroyCoupon')->name('destroyCoupon');

});
Route::post('/changepassword','Auth\\ChangePasswordController@changePassword')->name('changepassword');

Route::post('subscribe','Frontend\\FrontendController@subscribe')->name('subscribe');

Route::get('page/{slug}',function($slug){
	$page = App\Cms::where('slug',$slug)->first();
	return view('frontend/staticPage',compact('page'));
})->name('page');
//checkout controller

// Route::get('checkout/payment/complete', 'Frontend\CheckoutController@complete')->name('checkout.payment.complete');

// Route::get('checkout/payment/complete', 'Frontend\CheckoutController@complete')->name('checkout.payment.complete');

Route::post('product-variation','Admin\\ProductsController@get_variant_ajax');

//end cart routes
// Route::resource('admin/posts', 'Admin\\PostsController');
 

// Route::resource('admin/users', 'Admin\\UsersController');

// login with facebok
Route::get('/redirect', 'SocialAuthFacebookController@redirect');
Route::get('/callback', 'SocialAuthFacebookController@callback');

// login with google
Route::get('/google/redirect', 'SocialAuthGoogleController@redirect');
Route::get('/google/callback', 'SocialAuthGoogleController@callback');