<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserRoles;
use App\Models\City;
use App\Mail\SignupEmail;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function login(Request $request) {
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
    }

    public function signupHandler(Request $request) {
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
    }

    public function registerUser(Request $request) {
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
        $user_deets = User::where('email', session('register_user')['email'])
                        ->first();
        session(['user' => $user_deets]);
        $city = City::find(session('user')['city']);
        session(['user_loc' => $city]);
        $user_role = new UserRoles;
        $user_role->user_id = session('user')['user_id'];
        $user_role->role_id = $request->get('user_type');
        $user_role->save();
        $user_deets2 = User::where('email', session('register_user')['email'])
        ->with('roles')
        ->first();
        $user_roles = [];
        foreach($user_deets2['roles'] as $role) {
            array_push($user_roles, $role['role_id']);
        }
        session(['user_roles' => $user_roles]);
        Mail::to(session('user')['email'])->send(new SignupEmail(session('user')['email']));
        return view('index');
    }

    public function logout(Request $request) {
        $val = $request->session()->pull('user');
        $val = $request->session()->pull('user_loc');
        $val = $request->session()->pull('admin');
        return view('login/login');
    }
}
