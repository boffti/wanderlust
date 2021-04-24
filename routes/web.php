<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TipController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SearchController;
use App\Mail\QueryEmail;
use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\Query;
use App\Models\Category;
use App\Models\Chat;

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

Route::view('/about', 'main_site/about');
Route::view('/immigrant-services', 'main_site/immigrant_services');
Route::view('/visitor-services', 'main_site/visitor_service');
Route::view('/contact', 'main_site/contact')->name('contact');
Route::view('/login', 'login/login');
Route::view('/signup', 'login/signup');

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::post('/login', [LoginController::class, 'login']);
Route::post('/signup-handler', [LoginController::class, 'signupHandler']);
Route::post('/register-user', [LoginController::class, 'registerUser']);

Route::post('/change-loc', [HomeController::class, 'changeLoc']);
Route::get('/more-tips', [HomeController::class, 'moreTips'])->name('all-tips');
Route::get('/more-posts', [HomeController::class, 'morePosts'])->name('all-posts');

Route::post('/search', [SearchController::class, 'search']);

Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/profile', [UserController::class, 'getProfile'])->name('profile');
Route::post('/profile/edit/{user_id}', [UserController::class, 'editProfile']);

Route::post('/post', [PostController::class, 'addPost']);
Route::get('/post/delete/{post_id}/{loc}', [PostController::class, 'deletePost']);

Route::post('/tip', [TipController::class, 'addTip']);
Route::get('/tip/delete/{tip_id}/{loc}', [TipController::class, 'deleteTip']);

Route::get('/user/{user_id}', [UserController::class, 'getUser']);
Route::post('/dp', [UserController::class, 'updateDP']);
Route::post('/photo', [UserController::class, 'addPhoto']);
Route::post('/video', [UserController::class, 'addVideo']);

Route::get('/business/{business_id}', [BusinessController::class, 'getBusiness']);
Route::post('/business/photo/{business_id}', [BusinessController::class, 'addBusinessPhoto']);
Route::get('/business/tips/{business_id}', [BusinessController::class, 'getBusinessTips'])->name('business-tips');
Route::post('business/tips/{business_id}', [BusinessController::class, 'addBusinessTip']);
Route::get('/business/reviews/{business_id}', [BusinessController::class, 'getBusinessReviews'])->name('business-reviews');
Route::post('business/reviews/{business_id}', [BusinessController::class, 'addBusinessReview']);

Route::get('/country-admin', [AdminController::class, 'countryAdmin'])->name('country-admin');
Route::get('/super-admin', [AdminController::class, 'superAdmin'])->name('super-admin');

Route::post('/continent', [AdminController::class, 'addContinent']);
Route::get('/continent/delete/{continent_id}', [AdminController::class, 'deleteContinent']);

Route::post('/country', [AdminController::class, 'addCountry']);
Route::get('/country/delete/{country_id}', [AdminController::class, 'deleteCountry']);

Route::post('/city/{loc}', [AdminController::class, 'addCity']);
Route::get('/city/delete/{city_id}/{loc}', [AdminController::class, 'deleteCity']);

Route::post('/admin/add', [AdminController::class, 'addAdmin']);
Route::get('/admin/delete/{id}', [AdminController::class, 'deleteAdmin']);

Route::post('/business/{loc}', [AdminController::class, 'addBusiness']);
Route::get('/business/delete/{business_id}/{loc}', [AdminController::class, 'deleteBusiness']);

Route::post('/query', function(Request $request) {
    $c = new Query;
    $c -> first_name = $request->get('firstName');
    $c -> last_name = $request->get('lastName');
    $c -> country = $request->get('country');
    $c -> email = $request->get('email');
    $c -> phone = $request->get('phone');
    $c -> type = $request->get('userType');
    $c -> query = $request->get('query');
    Mail::to($request->get('email'))->send(new QueryEmail());
    $c -> save();

    return redirect()->route('contact');
});

Route::get('/query/delete/{queryid}', [AdminController::class, 'deleteQuery']);
Route::get('/user/delete/{user_id}', [AdminController::class, 'deleteUser']);

Route::get('/category', function() {
    return Category::all();
});

Route::get('/chat', function() {
    $chats = Chat::with('user')
    ->orderBy('created_at', 'ASC')
    ->take(20)
    ->get();
    return view('user/chat')
    -> with('chats', $chats);
});

Route::get('/send-chat/{msg}', function(Request $request, $msg) {
    $c = new Chat;
    $c -> user_id = session('user')['user_id'];
    $c -> message = $msg;
    $c->save();
    return session('user');
});

Route::get('/test', function() {
    $results = Business::where('city_id', 1)
        ->with(['city', 'category'])
        -> get();
        return $results;
});

Route::get('/session', function() {
    return session('admin');
});

Route::resource('city', '\App\Http\Controllers\CityController');
