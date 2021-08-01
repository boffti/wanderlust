<!--
    Author: Melkot, Aaneesh Naagaraj
    ID : 1001750503
-->
@extends('layouts.white')

@section('title', 'DS | ' . session('user')['full_name'])

@section('content')
    <br>
    <!-- hero -->
    <section class="flex">
        <div class="container">
            <div class="hero-text flex-vertical">
                <h1 id="" style="font-size: 35px;">{{ __("This is YOU.") }}</h1>
                <p class="">{{ __("What have you been up to lately? Use this page to upload your latest photos and videos.") }}</p>
            </div>
            <!-- <div class="card"> -->
            <div class="flex-left">
                <div class="flex-center">
                    <div class="card"
                        style="height: fit-content; width:100%; border-top: 4px var(--accent-color) solid;">
                        <div class="flex-center">
                            <div class="profile-img-container">
                                <img id="profileIMG" src="{{ URL::asset("upload/user_dp/") }}/{{ session('user')['dp'] }}" alt="profile" class=""
                                    style="width: 200px; border-radius: 100px;">
                                <div class="icon-change-image">
                                    <a id="changeDP" href="#">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </div>
                            </div>
                            <h2 id="" class="">{{ session('user')['full_name'] }}</h2>
                                <input type="file" name="dp" id="inputChangeDP" style="display: none;">
                        </div>
                    </div>
                    <div class="card" style="width: 100%;">
                        <div class="flex-left space-between">
                            <h3>{{ __("Your Details") }}</h3>
                            <a id="btnEditProfile" href="#"><i class="fas fa-edit"></i></a>
                        </div>
                        <br>
                        <div class="flex-column" style="align-items: flex-start;">
                            <span class="flex"><i class="fas fa-user" style="margin-right: 12px;"></i>
                                <p class="strong">{{ session('user')['full_name'] }}</p>
                            </span>
                            <span class="flex"><i class="fas fa-map-marker-alt" style="margin-right: 12px;"></i>
                                <p class=" strong">{{ session('user')['address'] }}</p>
                            </span>
                            <span class="flex"><i class="fas fa-birthday-cake" style="margin-right: 12px;"></i>
                                <p class="strong">{{ session('user')['dob'] }}</p>
                            </span>
                            <span class="flex"><i class="fas fa-suitcase" style="margin-right: 12px;"></i>
                                <p class="strong">{{ session('user')['profession'] }}</p>
                            </span>
                            <!-- <span class="flex"><i class="fas fa-globe-americas" style="margin-right: 12px;"></i>
                                <p class="strong">{{ session('user')['nationality'] }}</p>
                            </span> -->
                            <span class="flex"><i class="fas fa-phone-alt" style="margin-right: 12px;"></i>
                                <p class="strong">{{ session('user')['mobile'] }}</p>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <ul class="tabs">
                        @if(in_array('1', session('user_roles')))
                        <li class="active">{{ __("PHOTOS") }}</li>
                        <li>{{ __("VIDEOS") }}</li>
                        <li>{{ __("POSTS") }}</li>
                        <li>{{ __("TIPS") }}</li>
                        @else
                        <li class="active">{{ __("POSTS") }}</li>
                        @endif
                    </ul>

                    <ul class="tab-content">
                        @if(in_array('1', session('user_roles')))
                        <!-- Photos Tab -->
                        <li class="active">
                            <div class="tab-content-container">
                                <div class="flex">
                                    <h2 class="">{{ __("Your photos") }} - <span></span></h2>
                                    <button id="btnUploadPhoto" class="btn">{{ __("ADD") }}</button>
                                    <input type="file" name="user_photo" id="uploadPhotoInput" style="display: none;" />
                                </div>
                                {{-- <div class="gallery-container">
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
                                </div> --}}
                                <div class="gallery">
                                    @if(isset($user['photos']))
                                    @foreach($user['photos'] as $photo)
                                    <div class="gallery-item">
                                        <img class="gallery-image" src="{{ URL::asset('upload/user_photos/') }}/{{ $photo['photo_uri'] }}">
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
                                    <h2 class="">{{ __("Your Videos") }} - <span></span></h2>
                                    <button id="btnUploadVideo" class="btn">{{ __("ADD") }}</button>
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
                                <h2 class="">{{ __("Your Posts") }}</h2>
                                <div class="posts">
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
                                                <div class="flex tip-footer" style="gap: 10px; ">
                                                    <a href="{{ route('deletePost', [app()->getLocale(), $post['post_id'], 3]) }}" style="margin: 0;"><i class="fas fa-trash-alt"></i></a>
                                                </div>
                                            </div>

                                        </div>
                                    @endforeach
                                @endif

                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="tab-content-container">
                                <h2 class="">{{ __("Your Tips") }}</h2>
                                @if(isset($user['tips']))
                                    @foreach($user['tips'] as $tip)
                                    <div class="card border-l-yellow">
                                        <div class="flex flex-column align-items-left">
                                            <div>
                                                <span class="quotes">"</span><strong>
                                                    {{ $tip['tip_content'] }}
                                                </strong><span class="quotes">"</span>
                                            </div>
                                            <div class="flex ml-auto tip-footer" style="gap: 10px; ">
                                                <a href="{{ route('deleteTip', [app()->getLocale(), $tip['tip_id'], 3]) }}" style="margin: 0;"><i class="fas fa-trash-alt"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif


                                </div>

                            </div>
                        </li>
                        @else
                        <li class="active">
                            <div class="tab-content-container">
                                <h2 class="">{{ __("Your Posts") }}</h2>
                                <div class="posts">
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
                                                <div class="flex tip-footer" style="gap: 10px; ">
                                                    <a href="/post/delete/{{ $post['post_id'] }}" style="margin: 0;"><i class="fas fa-trash-alt"></i></a>
                                                </div>
                                            </div>

                                        </div>
                                    @endforeach
                                @endif

                                </div>
                            </div>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
            <!-- </div> -->
        </div>
    </section>

    <br>
<div id="welcome-string'" style="display:none;"></div>
<div id="typed" style="display:none;"></div>

<div id="profile-edit-modal-container" class="modal-container">
    <div class="modal" id="profile-edit-modal">
        <div class="modal-header flex-left space-between" style="align-items: center;">
            <p style="margin-left: 12px;">{{ __("Edit your deets") }}</p>
            <a href="#" class="cancel" style="float: right;">x</a>
        </div>
        <div class="modal-content" style="align-items:center;">
            <form action="/profile/edit/{{ $user['user_id'] }}" method="post" class="flex-center" style="gap: 12px;">
                @csrf
                <div class="flex-left">
                    <input type="text" name="name" placeholder="Name" value="{{ $user['full_name'] }}">
                    {{-- <input type="text" name="country" placeholder="City" value="{{ $user['city']['city_name'] }}"> --}}
                </div>
                <div class="flex-left">
                    <input type="text" name="phone" placeholder="Phone" pattern="[0-9]{10}" title="10 digits" value="{{ $user['mobile'] }}">
                    <input type="text" name="dob" placeholder="Date of birth"
                    pattern="[0-1][0-9]/[0-3][0-9]/[0-9][0-9]"
                    title="mm/dd/yy"
                    value="{{ $user['dob'] }}">
                </div>
                <div class="flex-left">
                    <input type="text" name="address" placeholder="Street Address" value="{{ $user['address'] }}">
                    <input type="text" name="profession" placeholder="Profession" value="{{ $user['profession'] }}">
                </div>
                <div>
                    <button class="cancel btn btn-outline-secondary text-secondary">{{ __("Cancel") }}</button>
                    <button class="btn" type="submit">{{ __("Change") }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
