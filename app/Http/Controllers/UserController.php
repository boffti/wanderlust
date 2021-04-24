<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserPhoto;
use App\Models\UserVideo;

class UserController extends Controller
{
    public function getProfile(Request $request) {
        if($request->session()->has('user')) {
            $user = User::where('user_id', session('user')['user_id'])
                        -> with(['city','photos', 'videos', 'posts', 'tips'])
                        -> first();
            return view('user/profile')
                -> with('user', $user);
        }
    }

    public function editProfile(Request $request, $user_id) {
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
    }

    public function getUser(Request $request, $user_id) {
        $user = User::where('user_id', $user_id)
                -> with(['photos', 'videos', 'posts', 'tips'])
                -> first();
        return view('user/user')
            -> with('user', $user);
    }

    public function updateDP(Request $request) {
        $user = User::find(session('user')['user_id']);
        $dp = $request->file('file');
        $file_name = session('user')['user_id'] . "_dp_" . $dp->getClientOriginalName();
        $dp->move(public_path().'/upload/user_dp', $file_name);
        $user->dp = $file_name;
        $user->save();
        $user = User::find(session('user')['user_id']);
        session(['user' => $user]);
        return $dp;
    }

    public function addPhoto(Request $request) {
        $photo = $request->file('file');
        $file_name = session('user')['user_id'] . "_" . $photo->getClientOriginalName();
        $photo->move(public_path().'/upload/user_photos', $file_name);
        $u_photo = new UserPhoto;
        $u_photo->photo_uri = $file_name;
        $u_photo->user_id = session('user')['user_id'];
        $u_photo->save();
        return $photo;
    }

    public function addVideo(Request $request) {
        $video = $request->file('file');
        $file_name = session('user')['user_id'] . "_" . $video->getClientOriginalName();
        $video->move(public_path().'/upload/user_videos', $file_name);
        $u_video = new UserVideo;
        $u_video->video_uri = $file_name;
        $u_video->user_id = session('user')['user_id'];
        $u_video->save();
        return $video;
    }
}
