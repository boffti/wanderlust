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

Route::get('/about', function () {
    return view('main_site/about');
});

Route::get('/signup-handler', function () {

    
    return view('main_site/about');
});



Route::resource('posts', '\App\Http\Controllers\PostsController');
Route::resource('tips', '\App\Http\Controllers\TipsController');
Route::resource('business', '\App\Http\Controllers\BusinessController');
