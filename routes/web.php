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

use Illuminate\Support\Facades\Route;

// Route::get('/clear', function() {

//    Artisan::call('cache:clear');
//    Artisan::call('config:clear');
//    Artisan::call('config:cache');
//    Artisan::call('view:clear');

//    return "Cleared!";

// });

Route::get('/admin', 'HomeController@dashboard')->name('dashboard');

Route::get('login',function(){ abort(404); });
Route::get('admin_login',function(){ abort(404); });
Route::post('login', 'LoginController@login');
Route::post('admin_login', 'LoginController@adminLogin')->name('client.login');
Route::get('logout', 'LoginController@logout')->name('logout');

Route::get('/','FrontendController@index');
//Route::get('auth/login', 'IndexController@index')->name('index');
Route::get('admin/login', 'IndexController@index')->name('login');

Route::group(['prefix' => 'admin', 'namespace' => 'admin', 'middleware' => ['auth', 'admin']], function () {

    Route::resource('/', 'DashboardController');
    //USERS
    Route::resource('users', 'UserController');
    Route::post('user/status', 'UserController@change_block_status')->name('user.status.update');
    //chapters
    Route::resource('chapters', 'ChapterController');
    //Contact Us
    // Route::resource('contact_us', 'ContactUsController');
    // //Questions
    // Route::resource('questions', 'QuestionController');
});



///For Restaurant
Route::group(['prefix' => 'client', 'namespace' => 'client', 'middleware' => ['auth', 'client']], function () {
    //profile
    Route::get('profile', 'UserController@profile')->name('client.profile');
    Route::resource('/', 'DashboardController');

});

Route::group(['prefix' => 'merchant', 'namespace' => 'merchant', 'middleware' => ['auth', 'merchant']], function () {
    //Dashboard
    Route::resource('/', 'DashboardController');
    //Merchant Users
    Route::resource('merchant-users', 'UserController');

});

// Route::get('/', 'IndexController@index')->name('index');
// Route::get('/', 'IndexController@index')->name('login');



