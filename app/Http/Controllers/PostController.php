<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function addPost(Request $request) {
        $postContent = $request->get('post');
        $post = new Post;
        $post->post_content = $postContent;
        $post->user_id = session('user')['user_id'];
        $post->city_id = session('user_loc')['city_id'];
        $post->save();
        return redirect()->route('all-posts');
    }

    public function deletePost(Request $request, $post_id, $loc) {
        $post = Post::where('post_id', $post_id)->first();
        $post -> delete();
        if($loc == '1') {
            return redirect()->route('super-admin');
        } elseif($loc == '3') {
            return redirect()->route('profile');
        } else {
            return redirect()->route('country-admin');
        }
    }
}
