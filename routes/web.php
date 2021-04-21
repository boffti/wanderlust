<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use Illuminate\Http\Request;
use App\Models\User;

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
Route::view('/login', 'login/login');
Route::view('/signup', 'login/signup');

Route::get('/signup-handler', function () {
    return view('main_site/about');
});

Route::post('/login', function(Request $request) {
    $email = $request->get('email');
    $password = $request->get('password');
    $pass_hash = password_hash($password, PASSWORD_DEFAULT);
    $user = User::where('email', $email)->first();
    if(isset($user)) {
        if(password_verify($password, $user->password)) {
            session(['user' => $user]);
            return view('index');
        };
    }
    return view('login/login')->with('msg', 'Invalid Email/Password');
});

Route::get('/logout', function(Request $request) {
    $val = $request->session()->pull('user');
    return view('index');
});

Route::get('/business/city/{city_id}', function($city_id) {
    $results = DB::select("select * from business where city_id={$city_id}");
    return $results;
});

Route::get('/tips/city/{city_id}', function($city_id) {
    $results = DB::select("select t.tip_id, t.tip_content, u.user_id, u.full_name from tips as t, users as u where t.city_id={$city_id} and t.user_id=u.user_id");
    return $results;
});

Route::get('/posts/city/{city_id}', function($city_id) {
    $results = DB::select("select p.post_id, p.post_content, p.user_id, u.full_name from posts as p, users as u where city_id={$city_id} and p.user_id=u.user_id");
    return $results;
});

Route::get('/business/{business_id}', function($business_id) {
    $results = DB::select("select * from business where business_id={$business_id}");
    return $results;
});

Route::resource('posts', '\App\Http\Controllers\PostsController');
Route::resource('tips', '\App\Http\Controllers\TipsController');
Route::resource('business', '\App\Http\Controllers\BusinessController');
