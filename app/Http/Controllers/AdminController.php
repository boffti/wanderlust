<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Country;
use App\Models\City;
use App\Models\Category;
use App\Models\Query;
use App\Models\Continent;
use App\Models\User;
use App\Models\CountryAdmin;
use App\Models\UserRoles;
use App\Models\Business;

class AdminController extends Controller
{
    public function countryAdmin(Request $request) {
        $country_id = session('admin')['country_id'];
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
    }

    public function superAdmin(Request $request) {
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
    }

    public function addContinent(Request $request) {
        $c = new Continent;
        $c -> continent_name = $request->get('continent');
        $c -> save();
        return redirect()->route('super-admin');
    }

    public function deleteContinent(Request $request, $continent_id) {
        $c = Continent::find($continent_id);
        $c -> delete();
        return redirect()->route('super-admin');
    }

    public function addCountry(Request $request) {
        $c = new Country;
        $c -> country_name = $request->get('country');
        $c -> countinent_id = $request->get('continent_id');
        $c -> save();
        return redirect()->route('super-admin');
    }

    public function deleteCountry(Request $request, $country_id) {
        $c = Country::find($country_id);
        $c -> delete();
        return redirect()->route('super-admin');
    }

    public function addCity(Request $request, $loc) {
        $c = new City;
        $c -> city_name = $request->get('city');
        $c -> country_id = $request->get('country_id');
        $c -> save();
        if($loc == '1') {
            return redirect()->route('super-admin');
        } else {
            return redirect()->route('country-admin');
        }
    }

    public function deleteCity(Request $request, $city_id, $loc) {
        $c = City::find($city_id);
        $c -> delete();
        if($loc == '1') {
            return redirect()->route('super-admin');
        } else {
            return redirect()->route('country-admin');
        }
    }

    public function addAdmin(Request $request) {
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
    }

    public function deleteAdmin(Request $request, $id) {
        $ca = CountryAdmin::where('id', $id)->first();
        $ua = UserRoles::where('user_id', $ca->user_id)->where('role_id', '3')->first();
        $ua -> delete();
        $ca -> delete();
        return redirect()->route('super-admin');
    }

    public function addBusiness(Request $request, $loc) {
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
    }

    public function deleteBusiness(Request $request, $business_id, $loc) {
        $b = Business::where('business_id', $business_id)->first();
        $b -> delete();
        if($loc == '1') {
            return redirect()->route('super-admin');
        } else {
            return redirect()->route('country-admin');
        }
    }

    public function deleteQuery(Request $request, $queryid) {
        $c = Query::where('query_id', $queryid)->first();
        $c -> delete();
        return redirect()->route('super-admin');
    }

    public function deleteUser(Request $request, $user_id) {
        $c = User::where('user_id', $user_id)->first();
        $c -> delete();
        // TODO Delete User data from other tables
        return redirect()->route('super-admin');
    }
}
