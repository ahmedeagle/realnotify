<?php

use Illuminate\Support\Facades\Route;
define('PAGINATION_COUNT',10);

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('comment', 'HomeController@saveComment')->name('comment.save');


################Begin paymentGateways Routes ########################

Route::group(['prefix' => 'offers', 'middleware' => 'auth','namespace' =>'Offers'], function () {
    Route::get('/', 'OfferController@index')->name('offers.all');
    Route::get('details/{offer_id}', 'OfferController@show')->name('offers.show');
});

Route::get('get-checkout-id', 'PaymentProviderController@getCheckOutId')->name('offers.checkout');

################End paymentGateways Routes ########################





