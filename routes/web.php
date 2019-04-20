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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::post('/checkfqdn', 'UserController@checkfqdn');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::post('Potentialcustomer', 'PotentialCustomerController@store');
Route::get('anotherregister', 'Auth\RegisterController@showRegistrationForm')->name('anotherregister');
Route::post('anotherregister', 'Auth\RegisterController@register');
