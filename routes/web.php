<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PostsController;
use App\Mail\SignupEmail;
use App\Mail\QueryEmail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\City;
use App\Models\Country;
use App\Models\Continent;
use App\Models\Business;
use App\Models\Tip;
use App\Models\Post;
use App\Models\Query;
use App\Models\Category;
use App\Models\UserPhoto;
use App\Models\UserVideo;
use App\Models\BusinessPhoto;
use App\Models\BusinessTip;
use App\Models\BusinessReview;
use App\Models\CountryAdmin;
use App\Models\UserRoles;

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

Route::get('/', function (Request $request) {
    if($request->session()->has('user')) {
        if(!$request->session()->has('user')) {
            $city = City::find(session('user')['city']);
            session(['user_loc' => $city]);
        }
        $businesses = Business::where('city_id', session('user_loc')['city_id'])
        -> with(['city', 'category'])
        -> get()
        -> toArray();
        $business_response = array_slice($businesses, 0, 3);
        $tips = Tip::where('city_id', session('user_loc')['city_id'])
                -> with(['user'])
                -> get()
                -> toArray();
        $tips_response = array_slice($tips, 0, 5);
        $posts = Post::where('city_id', session('user_loc')['city_id'])
                -> with(['user'])
                -> get()
                -> toArray();
        $posts_response = array_slice($posts, 0, 5);
        $city_id = session('user_loc')['city_id'];
        $photos = DB::select("select up.photo_uri from user_photos as up, cities as c, users as u where u.user_id=up.user_id and u.city=c.city_id and c.city_id={$city_id}");
        $photos = array_map(function ($value) {
            return (array)$value;
        }, $photos);
        $photos_response = array_slice($photos, 0, 9);
        return view('index')
            -> with('businesses', $business_response)
            -> with('tips', $tips_response)
            -> with('posts', $posts_response)
            -> with('photos', $photos_response);
    } else {
        return view('index');
    }
})->name('home');

Route::post('/login', function(Request $request) {
    $email = $request->get('email');
    $password = $request->get('password');
    $user = User::where('email', $email)
                -> with(['city', 'roles'])
                -> first();
    if(isset($user)) {
        if(password_verify($password, $user->password)) {
            session(['user' => $user]);
            $city = City::find($user['city']);
            session(['user_loc' => $city]);
            $user_roles = [];
            foreach($user['roles'] as $role) {
                array_push($user_roles, $role['role_id']);
            }
            if(in_array('3', $user_roles)) {
                $results = DB::select("select c.country_id, c.country_name from users as u, countries as c, country_admins as ca where u.user_id=ca.user_id and ca.country_id=c.country_id and u.user_id={$user['user_id']}");
                $results = array_map(function ($value) {
                    return (array)$value;
                }, $results);
                session([ 'admin' => $results[0]]);
            }
            session(['user_roles' => $user_roles]);
            return redirect()->route('home');
        };
    }
    return view('login/login')->with('msg', 'Invalid Email/Password');
});

Route::post('/signup-handler', function (Request $request) {
    $user['full_name'] = $request->get('name');
    $user['email'] = $request->get('email');
    $password = $request->get('password');
    $rePass = $request->get('reenter-password');
    if($password != $rePass) {
        return view('login/signup')->with('msg', "Passwords don't match!");
    } else {
        $check_user = User::where('email', $user['email'])->first();
        if(isset($check_user)) {
            return view('login/signup')->with('msg', "User exists. Please login instead.");
        } else {
            $user['password'] = password_hash($password, PASSWORD_DEFAULT);
            session(['register_user' => $user]);
            $cities = City::all();
            return view('login/signup_wizard')
                -> with('cities', $cities);
        }
    }
});

Route::post('/register-user', function (Request $request) {
    $user = new User;
    $user->full_name = session('register_user')['full_name'];
    $user->email = session('register_user')['email'];
    $user->password = session('register_user')['password'];
    $user->mobile = $request->get('phone');
    $user->profession = $request->get('profession');
    $user->nationality = $request->get('nationality');
    $user->dob = $request->get('dob');
    $user->city  = $request->get('city');
    $user->address = $request->get('street_addr');
    $user->dp = "placeholder.png";
    $user->save();
    $user_deets = User::where('email', session('register_user')['email'])->first();
    session(['user' => $user_deets]);
    // $user_type = $request->get('user_type');
    Mail::to(session('user')['email'])->send(new SignupEmail(session('user')['email']));
    return view('index');
});

Route::post('/change-loc', function (Request $request) {
    $city_id = $request->get('location');
    $city = City::find($city_id);
    session(['user_loc' => $city]);
    return redirect()->route('home');
});

Route::get('/more-tips', function(Request $request) {
    if($request->session()->has('user')) {
        $tips = Tip::where('city_id', session('user_loc')['city_id'])
                    -> with(['user'])
                    -> get()
                    -> toArray();
        return view('user/tips')
            -> with('tips', $tips);
    } else {
        return view('user/tips');
    }

})->name('all-tips');

Route::get('/more-posts', function(Request $request) {
    if($request->session()->has('user')) {
        $posts = Post::where('city_id', session('user_loc')['city_id'])
                -> with(['user'])
                -> get()
                -> toArray();
        return view('user/posts')
            -> with('posts', $posts);
    } else {
        return view('user/posts');
    }
})->name('all-posts');

Route::get('/logout', function(Request $request) {
    $val = $request->session()->pull('user');
    $val = $request->session()->pull('user_loc');
    return view('login/login');
});

Route::get('/profile', function(Request $request) {
    if($request->session()->has('user')) {
        $user = User::where('user_id', session('user')['user_id'])
                    -> with(['city','photos', 'videos', 'posts', 'tips'])
                    -> first();
        return view('user/profile')
            -> with('user', $user);
    }
})->name('profile');

Route::post('/profile/edit/{user_id}', function(Request $request, $user_id) {
    if($request->session()->has('user')) {
        $user = User::where('user_id', $user_id);
        $user->update([
            'full_name' => $request->get('name'),
            'mobile' => $request->get('phone'),
            'dob' => $request->get('dob'),
            'address' => $request->get('address'),
            'profession' => $request->get('profession')
        ]);
        $user = User::where('user_id', $user_id)->first();
        session(['user' => $user]);
        return redirect()->route('profile');
    }
});

Route::post('/post', function(Request $request) {
    $postContent = $request->get('post');
    $post = new Post;
    $post->post_content = $postContent;
    $post->user_id = session('user')['user_id'];
    $post->city_id = session('user_loc')['city_id'];
    $post->save();
    return redirect()->route('all-posts');
});

Route::post('/tip', function(Request $request) {
    $tipContent = $request->get('tip');
    $tip = new Tip;
    $tip->tip_content = $tipContent;
    $tip->user_id = session('user')['user_id'];
    $tip->city_id = session('user_loc')['city_id'];
    $tip->save();
    return redirect()->route('all-tips');
});

Route::get('/tip/delete/{tip_id}/{loc}', function(Request $request, $tip_id, $loc) {
    $tip = Tip::where('tip_id', $tip_id)->first();
    $tip -> delete();
    if($loc == '1') {
        return redirect()->route('super-admin');
    } elseif($loc == '3') {
        return redirect()->route('profile');
    } else {
        return redirect()->route('country-admin');
    }
});

Route::get('/post/delete/{post_id}/{loc}', function(Request $request, $post_id, $loc) {
    $post = Post::where('post_id', $post_id)->first();
    $post -> delete();
    if($loc == '1') {
        return redirect()->route('super-admin');
    } elseif($loc == '3') {
        return redirect()->route('profile');
    } else {
        return redirect()->route('country-admin');
    }
});

Route::get('/user/{user_id}', function(Request $request, $user_id) {
    $user = User::where('user_id', $user_id)
                -> with(['photos', 'videos', 'posts', 'tips'])
                -> first();
    return view('user/user')
        -> with('user', $user);
});

Route::post('/dp', function(Request $request) {
    $user = User::find(session('user')['user_id']);
    $dp = $request->file('file');
    $file_name = session('user')['user_id'] . "_dp_" . $dp->getClientOriginalName();
    $dp->move(public_path().'/upload/user_dp', $file_name);
    $user->dp = $file_name;
    $user->save();
    $user = User::find(session('user')['user_id']);
    session(['user' => $user]);
    return $dp;
});

Route::post('/photo', function(Request $request) {
    $photo = $request->file('file');
    $file_name = session('user')['user_id'] . "_" . $photo->getClientOriginalName();
    $photo->move(public_path().'/upload/user_photos', $file_name);
    $u_photo = new UserPhoto;
    $u_photo->photo_uri = $file_name;
    $u_photo->user_id = session('user')['user_id'];
    $u_photo->save();
    return $photo;
});

Route::post('/video', function(Request $request) {
    $video = $request->file('file');
    $file_name = session('user')['user_id'] . "_" . $video->getClientOriginalName();
    $video->move(public_path().'/upload/user_videos', $file_name);
    $u_video = new UserVideo;
    $u_video->video_uri = $file_name;
    $u_video->user_id = session('user')['user_id'];
    $u_video->save();
    return $video;
});

Route::get('/business/{business_id}', function($business_id) {
    $results = Business::where('business_id', $business_id)
        -> first();
    $photos = BusinessPhoto::where('business_id', $business_id)
        -> with(['user'])
        -> get()
        -> toArray();
    $photos_response = array_slice($photos, 0, 5);
    $tips = BusinessTip::where('business_id', $business_id)
        -> with(['user'])
        -> get()
        -> toArray();
    $tips_response = array_slice($tips, 0, 5);
    $reviews = BusinessReview::where('business_id', $business_id)
        -> with(['user'])
        -> get()
        -> toArray();
    $reviews_response = array_slice($reviews, 0, 5);
    return view('business/business_detail')
        -> with('biz', $results)
        -> with('photos', $photos_response)
        -> with('tips', $tips_response)
        -> with('reviews', $reviews_response);
});

Route::post('/business/photo/{business_id}', function(Request $request, $business_id) {
    try {
        $photo = $request->file('file');
        $file_name = $business_id . "_" . $photo->getClientOriginalName();
        $photo->move(public_path().'/upload/business_photos', $file_name);
        $b_photo = new BusinessPhoto;
        $b_photo->photo_uri = $file_name;
        $b_photo->business_id = $business_id;
        $b_photo->user_id = session('user')['user_id'];
        $b_photo->save();
    } catch (Exception $e) {
        return $e->getMessage();
    }
    return 'success';
});

Route::get('/business/tips/{business_id}', function(Request $request, $business_id) {
    $results = Business::where('business_id', $business_id)
        -> first();
    $tips = BusinessTip::where('business_id', $business_id)
        -> with(['user'])
        -> get();
    return view('business/business_tips')
        -> with('biz', $results)
        -> with('tips', $tips);
})->name('business-tips');

Route::post('business/tips/{business_id}', function(Request $request, $business_id) {
    $b_tip = new BusinessTip;
    $b_tip->tip_content = $request->get('businessTip');
    $b_tip->business_id = $business_id;
    $b_tip->user_id = session('user')['user_id'];
    $b_tip->save();
    return redirect()->route('business-tips', $business_id);
});

Route::get('/business/reviews/{business_id}', function(Request $request, $business_id) {
    $results = Business::where('business_id', $business_id)
        -> first();
    $reviews = BusinessReview::where('business_id', $business_id)
        -> with(['user'])
        -> get();
    return view('business/business_reviews')
        -> with('biz', $results)
        -> with('reviews', $reviews);
})->name('business-reviews');

Route::post('business/reviews/{business_id}', function(Request $request, $business_id) {
    $b_rev = new BusinessReview;
    $b_rev->review_content = $request->get('review');
    $b_rev->rating = '4';
    $b_rev->business_id = $business_id;
    $b_rev->user_id = session('user')['user_id'];
    $b_rev->save();
    return redirect()->route('business-reviews', $business_id);
});

Route::get('/country-admin', function(Request $request) {
    $country_id =  session('admin')['country_id'];
    $countries = Country::all();
    $cities = City::where('country_id', $country_id)->get();
    $poi = DB::select("SELECT b.business_id, b.business_name, b.business_phone, b.business_address, c.city_name, cat.category_name from business as b, cities as c, categories as cat, countries as cn where b.city_id=c.city_id and b.category=cat.category_id and c.country_id=cn.country_id and cn.country_id={$country_id}");
    $poi = array_map(function ($value) {
        return (array)$value;
    }, $poi);
    $posts = DB::select("SELECT p.post_id, p.post_content, p.created_at, u.full_name, c.city_name from posts as p, users as u, cities as c, countries as cn where p.user_id=u.user_id and p.city_id=c.city_id and c.country_id=cn.country_id and cn.country_id={$country_id}");
    $posts = array_map(function ($value) {
        return (array)$value;
    }, $posts);
    $tips = DB::select("SELECT t.tip_id, t.tip_content, u.full_name, c.city_name from tips as t, users as u, cities as c, countries as cn where t.user_id=u.user_id and t.city_id=c.city_id and c.country_id=cn.country_id and cn.country_id={$country_id}");
    $tips = array_map(function ($value) {
        return (array)$value;
    }, $tips);
    $categories = Category::all();
    return view('admin/country_admin')
        ->with('cities', $cities)
        ->with('countries', $countries)
        ->with('poi', $poi)
        ->with('posts', $posts)
        ->with('tips', $tips)
        ->with('categories', $categories);

})->name('country-admin');

Route::get('/super-admin', function(Request $request) {
    $cities = City::all();
    $countries = Country::all();
    $continents = Continent::all();
    $admins = DB::select("select ca.id, u.full_name, u.email, c.country_name from users as u, countries as c, country_admins as ca where ca.user_id=u.user_id and ca.country_id=c.country_id");
    $admins = array_map(function ($value) {
        return (array)$value;
    }, $admins);
    $users = DB::select("SELECT users.user_id, users.full_name, users.email, cities.city_name from users, cities, countries where users.city=cities.city_id and cities.country_id=countries.country_id");
    $users = array_map(function ($value) {
        return (array)$value;
    }, $users);
    $poi = DB::select("SELECT b.business_id, b.business_name, b.business_phone, b.business_address, c.city_name, cat.category_name from business as b, cities as c, categories as cat where b.city_id=c.city_id and b.category=cat.category_id");
    $poi = array_map(function ($value) {
        return (array)$value;
    }, $poi);
    $posts = DB::select("SELECT p.post_id, p.post_content, p.created_at, u.full_name, c.city_name from posts as p, users as u, cities as c where p.user_id=u.user_id and p.city_id=c.city_id");
    $posts = array_map(function ($value) {
        return (array)$value;
    }, $posts);
    $tips = DB::select("SELECT t.tip_id, t.tip_content, u.full_name, c.city_name from tips as t, users as u, cities as c where t.user_id=u.user_id and t.city_id=c.city_id");
    $tips = array_map(function ($value) {
        return (array)$value;
    }, $tips);
    $queries = Query::all();
    $categories = Category::all();

    return view('admin/super_admin')
        ->with('cities', $cities)
        ->with('countries', $countries)
        ->with('continents', $continents)
        ->with('admins', $admins)
        ->with('users', $users)
        ->with('poi', $poi)
        ->with('posts', $posts)
        ->with('tips', $tips)
        ->with('categories', $categories)
        ->with('queries', $queries);
})->name('super-admin');

Route::post('/continent', function(Request $request) {
    $c = new Continent;
    $c -> continent_name = $request->get('continent');
    $c -> save();
    return redirect()->route('super-admin');
});

Route::get('/continent/delete/{continent_id}', function(Request $request, $continent_id) {
    $c = Continent::find($continent_id);
    $c -> delete();
    return redirect()->route('super-admin');
});

Route::post('/country', function(Request $request) {
    $c = new Country;
    $c -> country_name = $request->get('country');
    $c -> countinent_id = $request->get('continent_id');
    $c -> save();
    return redirect()->route('super-admin');
});

Route::get('/country/delete/{country_id}', function(Request $request, $country_id) {
    $c = Country::find($country_id);
    $c -> delete();
    return redirect()->route('super-admin');
});

Route::post('/city/{loc}', function(Request $request, $loc) {
    $c = new City;
    $c -> city_name = $request->get('city');
    $c -> country_id = $request->get('country_id');
    $c -> save();
    if($loc == '1') {
        return redirect()->route('super-admin');
    } else {
        return redirect()->route('country-admin');
    }
});

Route::get('/city/delete/{city_id}/{loc}', function(Request $request, $city_id, $loc) {
    $c = City::find($city_id);
    $c -> delete();
    if($loc == '1') {
        return redirect()->route('super-admin');
    } else {
        return redirect()->route('country-admin');
    }
});

Route::post('/admin/add', function(Request $request) {
    $email = $request->get('admin_email');
    $country_id = $request->get('country_id');
    $user = User::where('email', $email)->first();
    $country = Country::where('country_id', $country_id)->first();
    $ca = new CountryAdmin;
    $ca -> user_id = $user -> user_id;
    $ca -> country_id = $country -> country_id;
    $ca -> save();
    $ua = new UserRoles;
    $ua -> role_id = '3';
    $ua -> user_id = $user -> user_id;
    $ua -> save();
    return redirect()->route('super-admin');
});

Route::get('/admin/delete/{id}', function(Request $request, $id) {
    $ca = CountryAdmin::where('id', $id)->first();
    $ua = UserRoles::where('user_id', $ca->user_id)->where('role_id', '3')->first();
    $ua -> delete();
    $ca -> delete();
    return redirect()->route('super-admin');
});

Route::post('/business/{loc}', function(Request $request, $loc) {
    $b = new Business;
    $b -> business_name = $request->get('businessName');
    $b -> business_desc = $request->get('businessDesc');
    $b -> business_phone = $request->get('businessPhone');
    $b -> business_website = $request->get('businessWebsite');
    $b -> business_address = $request->get('businessAddress');
    $b -> city_id = $request->get('city_id');
    $b -> category = $request->get('category_id');
    $b -> photo_uri = $request->get('photoURI');
    $b -> save();

    if($loc == '1') {
        return redirect()->route('super-admin');
    } else {
        return redirect()->route('country-admin');
    }
});

Route::get('/business/delete/{business_id}/{loc}', function(Request $request, $business_id, $loc) {
    $b = Business::where('business_id', $business_id)->first();
    $b -> delete();
    if($loc == '1') {
        return redirect()->route('super-admin');
    } else {
        return redirect()->route('country-admin');
    }
});

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

Route::get('/query/delete/{queryid}', function(Request $request, $queryid) {
    $c = Query::where('query_id', $queryid)->first();
    $c -> delete();
    return redirect()->route('super-admin');
});

Route::get('/user/delete/{user_id}', function(Request $request, $user_id) {
    $c = User::where('user_id', $user_id)->first();
    $c -> delete();
    // TODO Delete User data from other tables
    return redirect()->route('super-admin');
});

Route::get('/category', function() {
    return Category::all();
});

Route::post('/search', function(Request $request) {
    $search_term = $request->get('search_term');
    $category_id = $request->get('categories');

    if($search_term == ""){
        $results = Business::where('city_id', session('user_loc')['city_id'])
        ->with(['category'])
        -> get();
        $similar = Business::where('city_id', session('user_loc')['city_id'])
        -> with(['category'])
        -> get()
        -> toArray();
        $similar = array_slice($similar, 0, 3);
    } else {
        $results = Business::where('category', $category_id)
        ->where('city_id', session('user_loc')['city_id'])
        ->orWhere('business_name', 'like', '%{$search_term}%')
        ->orWhere('business_desc', 'like', '%{$search_term}%')
        ->with(['category'])
        ->get();
        $similar = Business::where('city_id', session('user_loc')['city_id'])
        -> where('category', $category_id)
        -> with(['category'])
        -> get()
        -> toArray();
    }

    return view('user/search_page')
        ->with('similar', $similar)
        ->with('results', $results);

});

Route::get('/chat', function() {
    return view('user/chat');
});

Route::get('/user', function() {
    return session('user');
});

Route::get('/test/{user_id}', function($user_id) {
    $email = "boffti@gmail.com";
    Mail::to($email)->send(new SignupEmail($email));
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

Route::get('/session', function() {
    return session('admin');
});

// Route::resource('posts', '\App\Http\Controllers\PostsController');
// Route::resource('tips', '\App\Http\Controllers\TipsController');
// Route::resource('business', '\App\Http\Controllers\BusinessController');
Route::resource('city', '\App\Http\Controllers\CityController');
