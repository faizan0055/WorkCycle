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

use Defuse\Crypto\RuntimeTests;
use Illuminate\Support\Facades\Route;

Route::get('/clear', function() {

   Artisan::call('cache:clear');
   Artisan::call('config:clear');
   Artisan::call('config:cache');
   Artisan::call('view:clear');

   return "Cleared!";

});

Route::get('/admin', 'HomeController@dashboard')->name('dashboard');

// Route::get('login',function(){ abort(404); });
// Route::get('admin_login',function(){ abort(404); });
//Route::get('ulogin','LoginController@userLoginView');
//Route::post('user_login','LoginController@userLogin')->name('user.login');

Route::post('login', 'LoginController@login');
Route::post('admin_login', 'LoginController@adminLogin')->name('client.login');
Route::get('logout', 'LoginController@logout')->name('logout');

//Route::get('/','FrontendController@index');


Route::group(['prefix' => 'admin', 'namespace' => 'admin', 'middleware' => ['auth', 'admin']], function () {

    Route::resource('/', 'DashboardController');
    //USERS
    Route::resource('users', 'UserController');
    Route::get('/Show_Profile', 'UserController@profile')->name('show.profile1');
    Route::post('/Update_Profile', 'UserController@profile_update')->name('admin.profile_update');
    Route::get('/Edit_Profile', 'UserController@edit')->name('edit.profile');


    Route::post('user/status', 'UserController@change_block_status')->name('user.status.update');
    //Category
    Route::resource('categories', 'CategoryController');
    //Property
     Route::resource('propertiess', 'PropertyController');
    // //Advertisements
     Route::resource('advertisements', 'AdvertisementController');
    //Gallaries
    //Route::resource('galleries', 'GalleryController');
});



///For Restaurant
Route::group(['prefix' => 'client', 'namespace' => 'client', 'middleware' => ['auth', 'client']], function () {
    //profile
    //Route::get('profile', 'UserController@profile')->name('client.profile');
    Route::resource('/', 'DashboardController');
    Route::get('/Show_Profile', 'UserController@profile')->name('show.profile12');
    Route::post('/Update_Profile', 'UserController@profile_update')->name('client.profile_update');
    Route::get('/Edit_Profile', 'UserController@edit')->name('edit.profile');
    // property View
    Route::resource('property', 'PropertyController');

});

Route::group(['prefix' => 'merchant', 'namespace' => 'merchant', 'middleware' => ['auth', 'merchant']], function () {
    //Dashboard
    Route::resource('/', 'DashboardController');
    //Merchant Users
    //Route::resource('merchant-users', 'UserController');
    Route::get('/Show_Profile', 'UserController@profile')->name('show.profile');
    Route::post('/Update_Profile', 'UserController@profile_update')->name('merchant.profile_update');
    Route::get('/Edit_Profile', 'UserController@edit')->name('edit.profile');
    //Property
    Route::resource('properties', 'PropertyController');

});

Route::get('/', 'IndexController@index')->name('index');
Route::get('/', 'IndexController@index')->name('login');
Route::resource('/register', 'RegisterController');




