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

Route::get('/', function () { return view('welcome'); });
Route::get('/home', 'HomeController@index');

/* GET */
Route::get('mails/order', function()
{
    Mail::to('y.maeda@sei-ya.jp')->send(new App\Mail\Order);
});

Route::get('vintages/{region}/{vintage}', 'Vintages@find');
Route::get('cart', 'Carts@index');
Route::get('checkout', 'Carts@checkout');
Route::get('delivery', 'Carts@delivery');
Route::get('userLogin', 'UserLoginController@show');
Route::get('userLogout', 'UserLoginController@logout');

/* POST */
Route::post('checkout', 'OrderController@storeCustomerInfo');
Route::post('userLogin', 'UserLoginController@login');

/* DELETE */
Route::delete('carts/{barcode?}', 'Carts@remove');

/* PUT */
Route::put('carts/{barcode}/{qty}', 'Carts@update');

Route::group([ 'middleware' => 'auth:admin' ], function()
{
    Route::get('orders', function()
    {
        return 'Orders';
    });

    Route::get('goods-issues', function()
    {
        return 'Goods Issue';
    });
});
