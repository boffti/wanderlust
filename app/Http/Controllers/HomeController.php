<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Business;
use App\Models\Tip;
use App\Models\Post;

class HomeController extends Controller
{
    public function home(Request $request) {
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
    }

    public function changeLoc(Request $request) {
        $city_id = $request->get('location');
        if($city_id == "") {
            return redirect()->route('home')
            ->with('msg', 'City cannot be blank');
        };
        $city = City::find($city_id);
        session(['user_loc' => $city]);
        return redirect()->route('home');
    }

    public function moreTips(Request $request) {
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
    }

    public function morePosts(Request $request) {
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
    }
}
