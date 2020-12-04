<?php
$locale = '';
$segment = Request::segment(1);

if (in_array($segment, Config::get('app.locales')) &&
    $segment != Config::get('app.fallback_locale')) {
    App::setLocale($segment);
    $locale = $segment;
}

Route::group(
    [
        'middleware' => ['web'],
        'namespace' => 'Checkout',
        'prefix' => $locale
    ], function () {

	//Route::get('/cart', [ 'as' => 'cart', 'uses' => 'CartController@showCart']);
    //Route::get('/checkout', [ 'uses' => 'CartController@returnCheckout']);
    Route::get('/cart', [ 'as' => 'cart', 'uses' => 'CartController@showCheckout']);
    Route::get('/checkout', [ 'uses' => 'CartController@showCheckout']);
    //Route::get('/finish-checkout', [ 'uses' => 'CartController@redirectToCart']);
	
	Route::post('/add-to-cart', [ 'as' => 'add-to-cart', 'uses' => 'CartController@addToCart']);
    Route::post('/add-to-cart-redirect', [ 'as' => 'add-to-cart-redirect', 'uses' => 'CartController@addToCartRedirect']);
    Route::post('/add-from-cart', [ 'as' => 'add-from-cart', 'uses' => 'CartController@addFromCart']);
	Route::post('/delete-from-cart', [ 'as' => 'delete-from-cart', 'uses' => 'CartController@deleteFromCart']);
    Route::post('/delete-full-cart', [ 'as' => 'delete-full-cart', 'uses' => 'CartController@deleteFullCart']);
    Route::post('/checkout', [ 'as' => 'checkout', 'uses' => 'CartController@showCheckout']);
    Route::post('/finish-checkout', [ 'as' => 'finish-checkout', 'uses' => 'CartController@finishCheckout']);

    Route::post('/apply-code', [ 'as' => 'apply-code', 'uses' => 'CartController@applyCode']);
    Route::post('/delete-code', [ 'as' => 'delete-code', 'uses' => 'CartController@deleteCode']);
    

    
    // TESTS MAILS
    /*Route::get('/mail-registered', function(){ return view('emails.new-user'); });
    Route::get('/mail-order-confirmation', function(){return view('emails.payment-success'); });
    Route::get('/mail-course-open-es', function(){return view('emails.course-open-es'); });
    Route::get('/mail-course-open-en', function(){return view('emails.course-open-en'); });*/

    /*Route::get('/mail-gift-giver', function(){ return view('emails.tests.mail-gift-giver'); });
    Route::get('/mail-gift-given', function(){ return view('emails.tests.mail-gift-given'); });
    Route::get('/mail-order-admin', function(){ return view('emails.tests.mail-order-admin'); });
    Route::get('/mail-order-admin-gift', function(){ return view('emails.tests.mail-order-admin-gift'); });*/
});
?>