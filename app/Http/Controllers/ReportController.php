<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Country;
use App\Models\Continent;
use App\Models\User;
use App\Models\Business;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tip;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function getDataSuper() {
        if(in_array('4', session('user_roles'))) {
            $countries = [];
            foreach(Country::all() as $country) {
                array_push($countries, $country['country_name']);
                $user_count = 0;
                $business_count = 0;
                $city_ids = DB::select("select city_id from cities where country_id={$country['country_id']}");
                foreach($city_ids as $city) {
                    $users = DB::select("select user_id from users where city={$city->city_id}");
                    $businessess = DB::select("select business_id from business where city_id={$city->city_id}");
                    $user_count += count($users);
                    $business_count += count($businessess);
                }
                $userByCountry[$country['country_name']] = $user_count;
                $businessByCountry[$country['country_name']] = $business_count;
            }
            $data['countries'] = $countries;
            $data['users'] = $userByCountry;
            $data['business'] = $businessByCountry;
            return $data;
        } else return null;
    }

    public function getDataCountry() {
        if(in_array('3', session('user_roles'))) {
            $cities = [];
            $country_id = session('admin')['country_id'];
            $city_ids = DB::select("select city_id, city_name from cities where country_id={$country_id}");
            $immigrant_count = 0;
            $visitor_count = 0;
            foreach($city_ids as $city) {
                array_push($cities, $city->city_name);
                $immigrants = DB::select("select u.user_id from users as u, user_roles as ur where u.city={$city->city_id} and u.user_id=ur.user_id and ur.role_id=1");
                $visitors = DB::select("select u.user_id from users as u, user_roles as ur where u.city={$city->city_id} and u.user_id=ur.user_id and ur.role_id=2");
                $immigrant_count = count($immigrants);
                $visitor_count = count($visitors);
                $data[$city->city_name]['immigrants'] = $immigrant_count;
                $data[$city->city_name]['visitors'] = $visitor_count;
            }
            $data['cities'] = $cities;
            return $data;
        } else return null;
    }

    public function getGeneralData() {
        $users = count(User::all());
        $business = count(Business::all());
        $post = count(Post::all());
        $tip = count(Tip::all());
        return [$users, $business, $post, $tip];
    }
}
