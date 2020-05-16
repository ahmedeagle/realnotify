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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('comment', 'HomeController@saveComment')->name('comment.save');

Route::get('test', function () {
    $data = [
        'user_id' => 44,
        'comment' => 'dfdfdf',
        'post_id' => 33,
    ];

    event(new App\Events\NewNotification($data));
    return "Event has been sent!";
});
