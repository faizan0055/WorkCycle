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
Route::get('forget_password', 'ForgetPassController@index')->name('forget.pass');
Route::get('/Show_Profile', 'UserController@profile1')->name('show.profile');
Route::post('/Update_Profile', 'UserController@profile_update')->name('profile_update');
Route::get('/Edit_Profile', 'UserController@edit')->name('edit.profile');
Route::get('/password', 'UserController@changepass')->name('change.pass');
//Route::get('/check-pwd','AdminController@chkPassword');
Route::post('/update-password','UserController@updatePwd')->name('update.password');
//Route::get('/','FrontendController@index');


Route::group(['prefix' => 'admin', 'namespace' => 'admin', 'middleware' => ['auth', 'admin']], function () {

    Route::resource('/', 'DashboardController');

    //USERS
    Route::resource('users', 'UserController');
    Route::post('user/status', 'UserController@change_block_status')->name('user.status.update');
    //Category
    Route::resource('categories', 'CategoryController');
    //Property
     Route::resource('propertiess', 'PropertyController');
    // //Advertisements
     Route::resource('advertisements', 'AdvertisementController');
    //Consults
    Route::resource('consults1', 'ConsultController');
});
///For Restaurant
Route::group(['prefix' => 'client', 'namespace' => 'client', 'middleware' => ['auth', 'client']], function () {
    //profile
    //Route::get('profile', 'UserController@profile')->name('client.profile');
    Route::resource('/', 'DashboardController');
    // property View
    Route::resource('property', 'PropertyController');
    //Consults
    Route::resource('consults', 'ConsultController');
});

Route::group(['prefix' => 'merchant', 'namespace' => 'merchant', 'middleware' => ['auth', 'merchant']], function () {
    //Dashboard
    Route::resource('/', 'DashboardController');
    //Merchant Users
    //Route::resource('merchant-users', 'UserController');
    //Property
    Route::resource('properties', 'PropertyController');
    //Consults
//    Route::resource('consults2', 'ConsultController');

});
//login
Route::get('/', 'IndexController@index')->name('index');
Route::get('/login', 'IndexController@index')->name('login');

//Register
Route::resource('/register', 'RegisterController');

//FrontEnd Routes
Route::get('/', 'FrontEndController@index')->name('index');
Route::get('/about_page', 'FrontEndController@about')->name('about.page');
Route::get('/property_grid', 'FrontEndController@propertyGrid')->name('property.grid');
Route::get('/blog_grid', 'FrontEndController@blogGrid')->name('blog.grid');
Route::get('/property_single', 'FrontEndController@ProperSingle')->name('property.single');
Route::get('/blog_single', 'FrontEndController@BlogSingle')->name('blog.single');
Route::get('/agents_grid', 'FrontEndController@agentGrid')->name('agent.grid');
Route::get('/agent_single', 'FrontEndController@agentSigle')->name('agent.single');
Route::get('/contact', 'FrontEndController@contact')->name('contact');



