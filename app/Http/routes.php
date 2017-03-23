<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['as' => 'v1::', 'prefix' => 'v1'], function () {
    Route::group(['middleware' => ['api']], function () {
        Route::get('cart/buy', ['as' => 'v1.cart.buy', 'uses' => 'V1\CartController@buy']);
        Route::get('cart/empty', ['as' => 'v1.cart.empty', 'uses' => 'V1\CartController@emptyCart']);
        Route::get('cart/remove/{id}', ['as' => 'v1.cart.remove', 'uses' => 'V1\CartController@remove']);
        Route::get('cart/add/{id}', ['as' => 'v1.cart.add', 'uses' => 'V1\CartController@add']);
        Route::get('cart', ['as' => 'v1.cart.index', 'uses' => 'V1\CartController@index']);
        Route::resource('address', 'V1\AddressController', ['only' => ['store']]);
        Route::resource('video', 'V1\VideoController',  ['only' => ['index', 'show']]);
        Route::get('video/play/{id}', ['as' => 'v1.video.play', 'uses' => 'V1\VideoController@play']);
        Route::get('purchase/direct/{id}', ['as' => 'v1.purchase.buydirect', 'uses' => 'V1\PurchaseController@buyDirect']);
        Route::get('purchase/{id}', ['as' => 'v1.purchase.buy', 'uses' => 'V1\PurchaseController@buy']);
        Route::resource('purchase', 'V1\PurchaseController', ['only' => ['index']]);
        Route::patch('avatar', ['as' => 'v1.avatar.update', 'uses' => 'V1\AvatarController@update']);
        Route::patch('user', ['as' => 'v1.user.update', 'uses' => 'V1\UserController@update']);
        Route::delete('session', [
            'as' => 'v1.session.destroy', 'uses' => 'V1\SessionController@destroy']);
        Route::delete('promo/codes/{promo}', [
            'as' => 'v1.promo.invalidate', 'uses' => 'V1\PromoController@invalidate']);
        Route::resource('promo', 'V1\PromoController');
        Route::resource('cashier', 'V1\CashierController');
        Route::post('cashier/addcard', [
            'as' => 'v1.card.post', 'uses' => 'V1\CashierController@addCard']);
    });
    Route::group(['middleware' => ['api.noauth']], function () {
        Route::resource('catalog', 'V1\CatalogController',  ['only' => ['index', 'show']]);
        Route::resource('category', 'V1\CategoryController',  ['only' => ['index', 'show']]);
        Route::resource('rating', 'V1\RatingController',  ['only' => ['index', 'show']]);
        Route::resource('user', 'V1\UserController', ['only' => ['store']]);
        Route::resource('session', 'V1\SessionController',  ['only' => ['store']]);
        Route::post('reset', ['as' => 'v1.password.resetrequest', 'uses' => 'V1\SessionController@requestPasswordReset']);
    });
});
// CEEK ROUTES
Route::group(['middleware' => ['ceek']], function () {
    Route::get('v2/cart/buy', ['as' => 'ceek.cart.buy',
        'uses' => '\Ceek\Http\Controllers\CeekController@cartBuy']);
    Route::get('v2/cart/empty', ['as' => 'ceek.cart.empty',
        'uses' => '\Ceek\Http\Controllers\CeekController@cartEmpty']);
    Route::get('v2/cart/remove/{id}', ['as' => 'ceek.cart.remove',
        'uses' => '\Ceek\Http\Controllers\CeekController@cartRemove']);
    Route::get('v2/cart/add/{id}', ['as' => 'ceek.cart.add',
        'uses' => '\Ceek\Http\Controllers\CeekController@cartAdd']);
    Route::get('v2/cart', ['as' => 'ceek.cart.index',
        'uses' => '\Ceek\Http\Controllers\CeekController@cartIndex']);
    Route::get('v2/special/megadeth/rights', ['as' => 'ceek.special.megadethrights.index',
        'uses' => '\Ceek\Http\Controllers\CeekController@megadethRightsIndex']);
    Route::get('v2/special/megadeth', ['as' => 'ceek.special.megadeth.index',
        'uses' => '\Ceek\Http\Controllers\CeekController@megadethIndex']);
    Route::post('v2/special/megadeth/purchase', ['as' => 'ceek.special.megadeth.purchase.store',
        'uses' => '\Ceek\Http\Controllers\CeekController@megadethBuy']);
    Route::post('v2/special/megadeth/quickpurchase', ['as' => 'ceek.special.megadeth.quickpurchase.store',
        'uses' => '\Ceek\Http\Controllers\CeekController@megadethQuickBuy']);
    Route::get('v2/promo/{id}', ['as' => 'ceek.promo.show',
        'uses' => '\Ceek\Http\Controllers\CeekController@promoShow']);
    Route::get('v2/promo', ['as' => 'ceek.promo.index',
        'uses' => '\Ceek\Http\Controllers\CeekController@promoIndex']);

//Enable this route to create promos
    // //Create promo
    // Route::post('v2/promo', ['as' => 'ceek.promo.store',
    //     'uses' => '\Ceek\Http\Controllers\CeekController@promoStore']);
    // //Invalidate promo
    // Route::delete('v2/promo/{id}', ['as' => 'ceek.promo.destroy',
    //     'uses' => '\Ceek\Http\Controllers\CeekController@promoInvalidate']);
    // //Invalidate promo codes only
    // Route::delete('v2/promo/codes/{id}', ['as' => 'ceek.promo.destroy',
    //     'uses' => '\Ceek\Http\Controllers\CeekController@promoCodesInvalidate']);

    Route::post('v2/cashier', ['as' => 'ceek.cashier.store',
        'uses' => '\Ceek\Http\Controllers\CeekController@cashierStore']);
    Route::post('v2/cashier/addcard', ['as' => 'ceek.card.post',
        'uses' => '\Ceek\Http\Controllers\CeekController@cashierAddcard']);
    Route::post('v2/purchase/play', ['as' => 'ceek.purchase.play',
        'uses' => '\Ceek\Http\Controllers\CeekController@purchasePlay']);
    Route::post('v2/purchase', ['as' => 'ceek.purchase.store',
        'uses' => '\Ceek\Http\Controllers\CeekController@purchaseStore']);
    Route::get('v2/purchase', ['as' => 'ceek.purchase.index',
        'uses' => '\Ceek\Http\Controllers\CeekController@purchaseIndex']);
    Route::post('v2/video', ['as' => 'ceek.video.update',
        'uses' => '\Ceek\Http\Controllers\CeekController@videoStoreImage']);
    Route::patch('v2/avatar', ['as' => 'ceek.avatar.update',
        'uses' => '\Ceek\Http\Controllers\CeekController@avatarUpdate']);
    Route::delete('v2/session', ['as' => 'ceek.session.destroy',
        'uses' => '\Ceek\Http\Controllers\CeekController@sessionDestroy']);
    Route::patch('v2/user', ['as' => 'ceek.user.update',
        'uses' => '\Ceek\Http\Controllers\CeekController@userUpdate']);
    Route::post('v2/address', ['as' => 'ceek.address.store',
        'uses' => '\Ceek\Http\Controllers\CeekController@addressStore']);
});
Route::group(['middleware' => ['ceek.noauth']], function () {
    Route::post('v2/reset', ['as' => 'ceek.password.resetrequest', 'uses' => '\Ceek\Http\Controllers\CeekController@requestPasswordReset']);
    Route::post('v2/special/megadeth/regbuy', ['as' => 'ceek.special.megadeth.regbuy',
        'uses' => '\Ceek\Http\Controllers\CeekController@megadethRegBuy']);
    Route::post('v2/session', ['as' => 'ceek.session.store',
        'uses' => '\Ceek\Http\Controllers\CeekController@sessionStore']);
    Route::post('v2/user', ['as' => 'ceek.user.store',
        'uses' => '\Ceek\Http\Controllers\CeekController@userStore']);
});
Route::group(['middleware' => ['ceek.midonly']], function () {
    Route::get('v2/rating', ['as' => 'ceek.rating.index',
        'uses' => '\Ceek\Http\Controllers\CeekController@ratingIndex']);
    Route::get('v2/rating/{id}', ['as' => 'ceek.rating.show',
        'uses' => '\Ceek\Http\Controllers\CeekController@ratingShow']);
    Route::get('v2/category', ['as' => 'ceek.category.index',
        'uses' => '\Ceek\Http\Controllers\CeekController@categoryIndex']);
    Route::get('v2/category/{id}', ['as' => 'ceek.category.show',
        'uses' => '\Ceek\Http\Controllers\CeekController@categoryShow']);
    Route::get('v2/video', ['as' => 'ceek.video.index',
        'uses' => '\Ceek\Http\Controllers\CeekController@videoIndex']);
    Route::get('v2/video/{id}', ['as' => 'ceek.video.show',
        'uses' => '\Ceek\Http\Controllers\CeekController@videoShow']);
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('password/reset', '\App\Http\Controllers\Auth\PasswordController@showLinkRequestForm');
    Route::auth();
    Route::group(['middleware' => 'autologout'], function () {
        Route::post('register', ['as' => 'auth.register', 'uses' => '\Ceek\Http\Controllers\Auth\AuthController@register']);
        Route::post('login', ['as' => 'auth.login', 'uses' => '\Ceek\Http\Controllers\Auth\AuthController@login']);
        Route::get('register/facebook', ['as' => 'auth.socialite.facebook.out', 'uses' => '\Ceek\Http\Controllers\Auth\AuthController@redirectToProvider']);
    });
    Route::get('register/facebook/callback', ['as' => 'auth.socialite.facebook.in', 'uses' => '\Ceek\Http\Controllers\Auth\AuthController@handleProviderCallback']);
    
    Route::get('/',
        [
            'as' => 'pages.home',
            'uses' => '\Ceek\Http\Controllers\WebPagesController@index'
        ]
    );
    Route::get('/ceekars', ['as' => 'pages.ceek.ceekars', 'uses' => '\Ceek\Http\Controllers\WebPagesController@ceekars']);
    
    Route::get('/megadeth-vr-dystopia', ['as' => 'pages.ceek.megadeth', 'uses' => '\Ceek\Http\Controllers\WebPagesController@megadeth']);
    Route::get('/megadethvr', function() {
        return redirect()->route('pages.ceek.megadeth');
    });
    
    Route::get('/support', ['as' => 'pages.support', 'uses' => '\Ceek\Http\Controllers\WebPagesController@help']);
    Route::get('/privacy-policy', ['as' => 'pages.privacy', 'uses' => '\Ceek\Http\Controllers\WebPagesController@privacyPolicy']);
    Route::get('/contact', ['as' => 'pages.contact', 'uses' => '\Ceek\Http\Controllers\WebPagesController@contact']);
    Route::get('/about-us', ['as' => 'pages.about-us', 'uses' => '\Ceek\Http\Controllers\WebPagesController@aboutUs']);

    Route::get('/zombie-chase',
        [
            'as' => 'ceek.games.zombie',
            'uses' => '\Ceek\Http\Controllers\WebPagesController@zombieChase'
        ]
    );    
    Route::get('vr-headset',
        [
            'as' => 'pages.vr-headset',
            'uses' => '\Ceek\Http\Controllers\WebPagesController@vrHeadset'
        ]
    );        
    Route::get('/terms', 
        [
            'as' => 'pages.terms', 
            'uses' => '\Ceek\Http\Controllers\WebPagesController@terms'

        ]
    );

    Route::get('/careers', 
        [
            'as' => 'pages.careers', 
            'uses' => '\Ceek\Http\Controllers\WebPagesController@careers'
        ]
    );

    Route::get('/health-safety', 
        [
            'as' => 'pages.health', 
            'uses' => '\Ceek\Http\Controllers\WebPagesController@healthSafety'
        ]
    );

    Route::get('vr-healthcare-education',
        [
            'as' => 'pages.vr-labs',
            'uses' => '\Ceek\Http\Controllers\WebPagesController@vrLabs'
        ]
    );

    Route::get('/final-step/{id}', 
        [
            'as' => 'pages.final-step',
            'uses' => '\Ceek\Http\Controllers\WebPagesController@finalStep'
        ]
    );
    
    Route::post('/payment', 
        [
            'as' => 'pages.payment',
            'uses' => '\Ceek\Http\Controllers\WebPagesController@finalstepPost'
        ]
    );

    Route::get('/blog', 
        [
            'as' => 'pages.blog',
            'uses' => '\Ceek\Http\Controllers\WebPagesController@blogPage'
        ]
    );

    Route::get('/order-confirmed', ['as' => 'pages.order-confirmed', 'uses' => '\Ceek\Http\Controllers\WebPagesController@orderConfirmed']);    

    Route::get('list-countries.html', '\Ceek\Http\Controllers\WebPagesController@listCountries');
    Route::get('list-states.html', '\Ceek\Http\Controllers\WebPagesController@listStates');
    
    Route::group(['middleware' => ['auth']], function () {
        Route::get('dashboard', ['as' => 'pages.dashboard', 'uses' => '\Ceek\Http\Controllers\WebPagesController@dashboard']);
        Route::get('count', ['as' => 'ceek.user.count', 'uses' => '\Ceek\Http\Controllers\CeekController@userCount']);
    });
});

Route::group(['as' => 'v3::', 'prefix' => 'v3'], function () {
    Route::group(['middleware' => ['api.noauth']], function () {
        Route::post('auth/facebook', ['as' => 'auth.facebook.login', 'uses' => '\Ceek\Http\Controllers\Api\FacebookAuthController@login']);
    });
    Route::group(['middleware' => ['api']], function () {
        Route::get('payment/ready', ['as' => 'payment.update', 'uses' => '\Ceek\Http\Controllers\Api\PaymentController@ready']);
        Route::post('payment/update', ['as' => 'payment.update', 'uses' => '\Ceek\Http\Controllers\Api\PaymentController@update']);
        Route::post('payment/charge', ['as' => 'payment.charge', 'uses' => '\Ceek\Http\Controllers\Api\PaymentController@charge']);
    });
});

// Route::group(['middleware' => 'web'], function () {
//     Route::auth();
//
//     Route::get('/home', 'HomeController@index');
// });
//
// Route::group(['middleware' => 'web'], function () {
//     Route::auth();
//
//     Route::get('/home', 'HomeController@index');
// });
