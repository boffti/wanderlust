<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TipController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\QueryController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ReportController;
use App\Models\Category;

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
Route::redirect('/', '/en', 301);

Route::prefix('{language}')->group(function () {

    // Static View Routes ----------------------------------------------------------------------
    Route::view('/about', 'main_site/about')->name('about');;
    Route::view('/immigrant-services', 'main_site/immigrant_services')->name('immigrant_services');;
    Route::view('/visitor-services', 'main_site/visitor_service')->name('visitor_services');;
    Route::view('/contact', 'main_site/contact')->name('contact');
    Route::view('/login', 'login/login')->name('login');
    Route::view('/signup', 'login/signup')->name('signup');
    // -----------------------------------------------------------------------------------------

    // Home Route ------------------------------------------------------------------------------
    Route::get('/', [HomeController::class, 'home'])->name('home');
    // -----------------------------------------------------------------------------------------

    // Login/Register Routes -------------------------------------------------------------------
    Route::post('/login', [LoginController::class, 'login'])->name('login_post');
    Route::post('/signup-handler', [LoginController::class, 'signupHandler'])->name('signupHandler');
    Route::post('/register-user', [LoginController::class, 'registerUser'])->name('registerUser');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    // -----------------------------------------------------------------------------------------

    // Home Page Misc Routes -------------------------------------------------------------------
    Route::get('/more-tips', [HomeController::class, 'moreTips'])->name('all-tips');
    Route::get('/more-posts', [HomeController::class, 'morePosts'])->name('all-posts');
    // -----------------------------------------------------------------------------------------

    // Search Route ----------------------------------------------------------------------------
    Route::post('/search', [SearchController::class, 'search'])->name('search');
    // -----------------------------------------------------------------------------------------

    // Change Location Route -------------------------------------------------------------------
    Route::post('/change-loc', [HomeController::class, 'changeLoc'])->name('change-loc');
    // -----------------------------------------------------------------------------------------

    // User Routes -----------------------------------------------------------------------------
    Route::get('/user/{user_id}', [UserController::class, 'getUser'])->name('user');
    Route::post('/dp', [UserController::class, 'updateDP'])->name('user');
    Route::post('/photo', [UserController::class, 'addPhoto'])->name('addPhoto');
    Route::post('/video', [UserController::class, 'addVideo'])->name('addVideo');
    Route::get('/profile', [UserController::class, 'getProfile'])->name('profile');
    Route::post('/profile/edit/{user_id}', [UserController::class, 'editProfile'])->name('editProfile');
    // -------------------------------------------------------------------------------------------

    // Business Routes ---------------------------------------------------------------------------
    Route::get('/business/{business_id}', [BusinessController::class, 'getBusiness'])->name('business');
    Route::post('/business/photo/{business_id}', [BusinessController::class, 'addBusinessPhoto']);
    Route::get('/business/tips/{business_id}', [BusinessController::class, 'getBusinessTips'])->name('business-tips');
    Route::post('business/tips/{business_id}', [BusinessController::class, 'addBusinessTip']);
    Route::get('/business/reviews/{business_id}', [BusinessController::class, 'getBusinessReviews'])->name('business-reviews');
    Route::post('/business/reviews/{business_id}', [BusinessController::class, 'addBusinessReview'])->name('addBusinessReview');
    Route::post('/business/{loc}', [AdminController::class, 'addBusiness']);
    Route::get('/business/delete/{business_id}/{loc}', [AdminController::class, 'deleteBusiness']);
    // ------------------------------------------------------------------------------------------

    // Admin Routes -----------------------------------------------------------------------------
    Route::get('/country-admin', [AdminController::class, 'countryAdmin'])->name('country-admin');
    Route::get('/super-admin', [AdminController::class, 'superAdmin'])->name('super-admin');
    Route::get('/report-data-super', [ReportController::class, 'getDataSuper']);
    Route::get('/report-data-country', [ReportController::class, 'getDataCountry']);
    Route::get('/general-data', [ReportController::class, 'getGeneralData']);
    // ------------------------------------------------------------------------------------------

    // Misc CRUD Routes -------------------------------------------------------------------------
    Route::post('/continent', [AdminController::class, 'addContinent']);
    Route::get('/continent/delete/{continent_id}', [AdminController::class, 'deleteContinent']);

    Route::post('/country', [AdminController::class, 'addCountry']);
    Route::get('/country/delete/{country_id}', [AdminController::class, 'deleteCountry']);

    Route::post('/city/{loc}', [AdminController::class, 'addCity']);
    Route::get('/city/delete/{city_id}/{loc}', [AdminController::class, 'deleteCity']);

    Route::post('/admin/add', [AdminController::class, 'addAdmin']);
    Route::get('/admin/delete/{id}', [AdminController::class, 'deleteAdmin']);

    Route::post('/post', [PostController::class, 'addPost'])->name('addPost');
    Route::get('/post/delete/{post_id}/{loc}', [PostController::class, 'deletePost'])->name('deletePost');

    Route::post('/tip', [TipController::class, 'addTip'])->name('addTip');
    Route::get('/tip/delete/{tip_id}/{loc}', [TipController::class, 'deleteTip'])->name('deleteTip');
    // -----------------------------------------------------------------------------------------

    // Query Routes ----------------------------------------------------------------------------
    Route::post('/query', [QueryController::class, 'sendQuery'])->name('sendQuery');
    Route::get('/query/delete/{queryid}', [AdminController::class, 'deleteQuery']);
    Route::get('/user/delete/{user_id}', [AdminController::class, 'deleteUser']);
    // -----------------------------------------------------------------------------------------

    // Chat Routes
    Route::get('/chat/{room_id}', [ChatController::class, 'getChat']);
    Route::get('/general-chat', [ChatController::class, 'getGeneralChat']);
    Route::get('/send-chat/{msg}', [ChatController::class, 'sendChat']);
    Route::get('/get-room-id', [ChatController::class, 'getRoomId']);
    // -----------------------------------------------------------------------------------------

    // Category Route
    Route::get('/category', function() {
        return Category::all();
    });
    // -----------------------------------------------------------------------------------------

    // City Resource
    Route::resource('city', '\App\Http\Controllers\CityController');
    // -----------------------------------------------------------------------------------------
});
