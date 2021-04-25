<!--
    Author: Melkot, Aaneesh Naagaraj
    ID : 1001750503
-->
@extends('layouts.white')

@section('title', 'WL | ' . session('user_loc')['city_name'] . " Posts")

@section('content')

    <div class="container">
        <h2>Posts in and around {{ session('user_loc')['city_name'] }}</h2>
        <form action="../../php/posts_handler.php" method="post">
            @csrf
            <div class="flex-left">
                <textarea placeholder="Whats on your mind? Type here..." name="post_content" id="bulletin_post" cols="30" rows="3"
                    style="width: 100%; padding:12px; margin: 12px" class="card"></textarea>
                <div class="card">
                    <p>See the latest buzz around you. Create your own buzz.</p>
                </div>
                <input name="loc" value="2" style="display:none;">
            </div>
            <button type="submit" class="btn" style="margin:0 12px;">POST</button>
        </form>
        <br>
        <div class="posts">
            @if(isset($posts))
            @foreach($posts as $post)
                <div class="card post">
                    <div class="flex-left">
                        <img class="postIMG" src="{{ URL::asset("upload/user_dp/") }}/{{ $post['user']['dp'] }}" alt="">
                        <div class="full-width">
                            <div class="flex-left space-between align-items-center">
                                <a href="/user/{{ $post['user']['user_id'] }}">
                                    <h4 class="">{{ $post['user']['full_name'] }}</h4>
                                </a>
                                <p class="post-date">{{ $post['created_at'] }}</p>
                            </div>
                            <p class="post-content">{{ $post['post_content'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

        </div>
    </div>

@endsection
