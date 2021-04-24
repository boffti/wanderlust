<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;

class SearchController extends Controller
{
    public function search(Request $request) {
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
        }
}
