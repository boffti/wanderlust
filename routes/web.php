<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;

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
    return view('index');
});
  

Route::view('/about', 'main_site/about');
Route::view('/immigrant-services', 'main_site/immigrant_services');
Route::view('/visitor-services', 'main_site/visitor_service');
Route::view('/contact', 'main_site/contact');

Route::view('/login-handler', 'login/login_handler');
Route::view('/login', 'login/login');
Route::view('/register-user', 'login/register_user');
Route::view('/signup', 'login/signup');

Route::view('/business-detail', 'business/business_detail');

Route::view('/search-page', 'user/search_page');
Route::view('/posts', 'user/posts');
Route::view('/profile', 'user/profile');

Route::view('/country-admin', 'admin/country_admin');
Route::view('/super-admin', 'admin/super_admin');

Route::get('/signup-handler', function () {
    return view('main_site/about');
});



Route::resource('posts', '\App\Http\Controllers\PostsController');
Route::resource('tips', '\App\Http\Controllers\TipsController');
Route::resource('business', '\App\Http\Controllers\BusinessController');
