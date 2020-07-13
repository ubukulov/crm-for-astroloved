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

Route::get('/login', 'IndexController@login')->name('login');
Route::post('/authenticate', 'IndexController@authenticate')->name('authenticate');
Route::get('/logout', 'IndexController@logout')->name('logout');
Route::group(['middleware' => ['web', 'auth']], function(){
    Route::get('/', 'IndexController@welcome')->name('home');
    Route::get('/payments', 'IndexController@payments');
    Route::get('/get-users', 'IndexController@getUsers');
    Route::get('/get-payments', 'IndexController@getPayments');
});
