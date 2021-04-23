<!--
    Author: Melkot, Aaneesh Naagaraj
    ID : 1001750503
-->
@extends('layouts.white')

@section('title', 'WL | ' . $user['full_name'])

@section('content')
    <br>
    <!-- hero -->
    <section class="flex">
        <div class="container">
            <div class="hero-text flex-vertical">
                <h1 id="" style="font-size: 35px;">This is {{ $user['full_name'] }}</h1>
            </div>
            <!-- <div class="card"> -->
            <div class="flex-left">
                <div class="flex-center">
                    <div class="card"
                        style="height: fit-content; width:100%; border-top: 4px var(--accent-color) solid;">
                        <div class="flex-center">
                            <div class="profile-img-container">
                                <img id="profileIMG" src="{{ URL::asset("upload/user_dp/") }}/{{ $user['dp'] }}" alt="profile" class=""
                                    style="width: 200px; border-radius: 100px;">
                                <div class="icon-change-image">
                                    <a id="" href="#">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </div>
                            </div>
                            <h2 id="" class="">{{ $user['full_name'] }}</h2>
                        </div>
                    </div>
                    <div class="card" style="width: 100%;">
                        <div class="flex-left space-between">
                            <h3>Details</h3>
                        </div>
                        <br>
                        <div class="flex-column" style="align-items: flex-start;">
                            <span class="flex"><i class="fas fa-user" style="margin-right: 12px;"></i>
                                <p class="strong">{{ $user['full_name'] }}</p>
                            </span>
                            <span class="flex"><i class="fas fa-map-marker-alt" style="margin-right: 12px;"></i>
                                <p class=" strong">{{ $user['address'] }}</p>
                            </span>
                            <span class="flex"><i class="fas fa-birthday-cake" style="margin-right: 12px;"></i>
                                <p class="strong">{{ $user['dob'] }}</p>
                            </span>
                            <span class="flex"><i class="fas fa-suitcase" style="margin-right: 12px;"></i>
                                <p class="strong">{{ $user['profession'] }}</p>
                            </span>
                            <!-- <span class="flex"><i class="fas fa-globe-americas" style="margin-right: 12px;"></i>
                                <p class="strong">{{ $user['nationality'] }}</p>
                            </span> -->
                            <span class="flex"><i class="fas fa-phone-alt" style="margin-right: 12px;"></i>
                                <p class="strong">{{ $user['mobile'] }}</p>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <ul class="tabs">
                        <li class="active">PHOTOS</li>
                        <li>VIDEOS</li>
                        <li>POSTS</li>
                        <li>TIPS</li>
                    </ul>

                    <ul class="tab-content">
                        <!-- Photos Tab -->
                        <li class="active">
                            <div class="tab-content-container">
                                <div class="flex">
                                    <input type="file" name="user_photo" id="uploadPhotoInput" style="display: none;" />
                                </div>
                                <div class="gallery-container">
                                    <!-- Define all of the tiles: -->

                                    @if(isset($user['photos']))
                                    @foreach($user['photos'] as $photo)
                                    <div class="box">
                                        <div class="img-box">
                                            <img
                                                src="{{ URL::asset('upload/user_photos/') }}/{{ $photo['photo_uri'] }}" />
                                        </div>
                                    </div>
                                    @endforeach
                                @endif

                                </div>
                            </div>
                        </li>

                        <!-- Videos Tab -->
                        <li>
                            <div class="tab-content-container">
                                <div class="flex">
                                    <input name="user_video" type="file" id="uploadVideoInput" style="display: none;" />
                                </div>

                                <div>
                                    @if(isset($user['videos']))
                                    @foreach($user['videos'] as $videos)
                                    <div class="video-container">
                                        <div class="">
                                            <video  width="500" height="315"
                                                src="{{ URL::asset('upload/user_videos/') }}/{{ $videos['video_uri'] }}" frameborder="0"
                                                allowfullscreen controls></video >
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                                </div>
                            </div>
                        </li>

                        <!-- Posts Tab -->
                        <li>
                            <div class="tab-content-container">
                                @if(isset($user['posts']))
                                    @foreach($user['posts'] as $post)
                                        <div class="card post">
                                            <div class="flex-left">
                                                <div class="full-width">
                                                    <div class="flex-left space-between align-items-center">
                                                        <p class="post-date">{{ $post['created_at'] }}</p>
                                                    </div>
                                                    <p class="post-content">{{ $post['post_content'] }}</p>
                                                </div>
                                            </div>

                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </li>
                        {{-- Tips --}}
                        <li>
                            <div class="tab-content-container">
                                @if(isset($user['tips']))
                                @foreach($user['tips'] as $tip)
                                <div class="card border-l-yellow">
                                    <div class="flex flex-column align-items-left">
                                        <div>
                                            <span class="quotes">"</span><strong>
                                                {{ $tip['tip_content'] }}
                                            </strong><span class="quotes">"</span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- </div> -->
        </div>
    </section>

    <br>
<div id="welcome-string'" style="display:none;"></div>
<div id="typed" style="display:none;"></div>
@endsection
