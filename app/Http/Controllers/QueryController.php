<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Query;
use App\Mail\QueryEmail;
use Illuminate\Support\Facades\Mail;

class QueryController extends Controller
{
    public function sendQuery(Request $request) {
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
        }
}
