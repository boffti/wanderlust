<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;

class SearchController extends Controller
{
    public function search(Request $request) {
        $search_term = $request->get('search_term');
        $category_id = $request->get('categories');

        if(session()->has('user_loc')) {
            if($category_id == "") {
                if($search_term == ""){
                    $results = Business::where('city_id', session('user_loc')['city_id'])
                    -> with(['category'])
                    -> get();
                    $similar = Business::where('city_id', session('user_loc')['city_id'])
                    -> inRandomOrder()
                    -> limit(3)
                    -> with('category')
                    -> get()
                    -> toArray();
                } else {
                    $results = Business::where('city_id', session('user_loc')['city_id'])
                    -> where('business_name', 'like', '%'.$search_term.'%')
                    -> orWhere('business_desc', 'like', '%'.$search_term.'%')
                    -> with(['category'])
                    -> get();
                    $similar = Business::where('city_id', session('user_loc')['city_id'])
                    -> inRandomOrder()
                    -> limit(3)
                    -> with(['category'])
                    -> get()
                    -> toArray();
                }
            } else {
                if($search_term == ""){
                    $results = Business::where('city_id', session('user_loc')['city_id'])
                    -> where('category', $category_id)
                    -> with(['category'])
                    -> get();
                    $similar = Business::where('city_id', session('user_loc')['city_id'])
                    -> where('category', $category_id)
                    -> inRandomOrder()
                    -> limit(3)
                    -> get()
                    -> toArray();
                } else {
                    $results = Business::where('city_id', session('user_loc')['city_id'])
                    -> where('category', $category_id)
                    -> where('business_name', 'like', '%'.$search_term.'%')
                    -> orWhere('business_desc', 'like', '%'.$search_term.'%')
                    -> with(['category'])
                    -> get();
                    $similar = Business::where('city_id', session('user_loc')['city_id'])
                    -> where('category', $category_id)
                    -> inRandomOrder()
                    -> limit(3)
                    -> with(['category'])
                    -> get()
                    -> toArray();
                }
            }
        } else {
            if($category_id == "") {
                if($search_term == ""){
                    $results = Business::with(['category'])
                    -> get();
                    $similar = Business::inRandomOrder()
                    -> limit(3)
                    -> with('category')
                    -> get()
                    -> toArray();
                } else {
                    $results = Business::where('business_name', 'like', '%'.$search_term.'%')
                    ->orWhere('business_desc', 'like', '%'.$search_term.'%')
                    ->with(['category'])
                    ->get();
                    $similar = Business::inRandomOrder()
                    -> limit(3)
                    -> with(['category'])
                    -> get()
                    -> toArray();
                }
            } else {
                if($search_term == ""){
                    $results = Business::where('category', $category_id)
                    -> with(['category'])
                    -> get();
                    $similar = Business::where('category', $category_id)
                    -> inRandomOrder()
                    -> limit(3)
                    -> get()
                    -> toArray();
                } else {
                    $results = Business::where('category', $category_id)
                    ->where('business_name', 'like', '%'.$search_term.'%')
                    ->orWhere('business_desc', 'like', '%'.$search_term.'%')
                    ->with(['category'])
                    ->get();
                    $similar = Business::where('category', $category_id)
                    -> with(['category'])
                    -> inRandomOrder()
                    -> limit(3)
                    -> get()
                    -> toArray();
                }
            }

        }

        return view('user/search_page')
            ->with('similar', $similar)
            ->with('results', $results);

        }
}
