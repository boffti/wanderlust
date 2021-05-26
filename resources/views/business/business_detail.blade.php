<!--
    Author: Melkot, Aaneesh Naagaraj
    ID : 1001750503
-->
@extends('layouts.white')

@section('title', "DS | ". $biz['business_name'])

@section('content')

    <div class="container">

        <!-- Search Bar -->
        <section class="flex">
            <form class="hero-form card flex" action="#">
                <div class="form-control">
                    <input type="text" name="search-term" id="search-term"
                        placeholder="{{ __("Keywords eg: food, salons, shopping etc") }}">
                </div>
                <div class="form-control"> <select name="categories" id="categories">
                    </select>
                </div>
                <button id="btnSearchNow" type="submit" href="#" class="btn" style="margin-left: 25px;">{{ __("SEARCH NOW") }}</button>
            </form>
        </section>
        <br>
        <!-- Business Header -->

        <section>
            <div class="flex-left" style="justify-content: space-between;">
                <div>
                    <h1 class="strong" style="font-size: 45px; margin-bottom:0;">
                        {{ $biz['business_name'] }}
                    </h1>
                    <div class="rating flex-left" style="font-size: 40px; align-items:center;">
                        <ul style="padding-left:0;">
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="far fa-star"></i></li>
                        </ul>
                        <span class="rating-count">{{ count($reviews) }} {{ __("reviews") }}</span>
                    </div>
                    <p class="business-category"></p>
                    <div class="business-timings">
                        <span style="color: var(--other-color-1); font-weight:bold; margin-right:10px;">{{ __("Open") }}</span> {{ __("Open 24 hours") }}</div>
                    <br>
                    <div>
                        <button id="btnWriteReview" class="btn" style="font-size: large;"><i class="far fa-star"
                                style="margin-right: 10px;"></i> {{ __("Write a Review") }}</button>
                        <button id="btnUploadBusinessPhoto" class="btn btn-outline-secondary text-secondary"
                            style="font-size: large;"><i class="fas fa-camera" style="margin-right: 10px;"></i> {{ __("Add Photo") }}</button>
                                <input id="fileBusinessPhoto" type="file" name="business_photo" biz_id="{{ $biz['business_id'] }}" style="display: none;">
                        <button class="btn btn-outline-secondary text-secondary" style="font-size: large;"><i
                                class="fas fa-share-alt" style="margin-right: 10px;"></i> {{ __("Share") }}</button>
                    </div>
                </div>

                <div style="margin-top:1.2em;">
                    <span><i class="fas fa-external-link-alt" style="margin-right:8px;"></i><a href="#"
                            class="text-accent" style="margin-bottom:12px;">{{ $biz['business_website'] }}</a></span>
                    <p><i class="fas fa-phone-alt" style="margin-right:8px;"></i> {{ $biz['business_phone'] }}</p>
                </div>
            </div>
        </section>
        <br>
        <hr>
        <br>


        <section>
            <div>
                <h2>{{ __("COVID-19 Safety Measures") }}</h2>
                <div class="flex-left" style="justify-content: space-between;">
                    <span class="strong"><i class="fas fa-check wander-green" style="margin-right:8px"></i>{{ __("Staff wears masks") }}</span>
                    <span class="strong"><i class="fas fa-check wander-green" style="margin-right:8px"></i>{{ __("Sanitized frequently") }}</span>
                    <span class="strong"><i class="fas fa-check wander-green" style="margin-right:8px"></i>{{ __("Staff wears gloves") }}</span>
                    <span class="strong"><i class="fas fa-check wander-green" style="margin-right:8px"></i>{{ __("Staff temperature checks") }}</span>
                    <span class="strong"><i class="fas fa-check wander-green" style="margin-right:8px"></i>{{ __("Contactless payments") }}</span>
                </div>
            </div>
        </section>

        <br>
        <hr>
        <br>

        <!-- Business Description Section -->
        <section>
            <div>
                <h2>{{ __("About the Business") }}</h2>
                <div class="card">
                    <p>{{ $biz['business_desc'] }}</p>
                </div>
            </div>
        </section>

        <br>
        <hr>
        <br>

        <!-- Photo Gallery Section -->
        <section>
            <div>
                <div class="flex-left" style="justify-content: space-between;">
                    <h2>{{ __("Photos") }}</h2>
                    {{-- <a href="#">See more</a> --}}
                </div>
                <div class="flex-left">

                    <div class="gallery">
                        @if(isset($photos))
                        @foreach($photos as $photo)
                        <div class="gallery-item">
                            <img class="gallery-image" src="{{ URL::asset('upload/business_photos/') }}/{{ $photo['photo_uri'] }}">
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
            {{-- <div class="flex" style="justify-content: space-between; padding: 0 15px">
                <a href="/business/photos/{{ $biz['business_id'] }}" class="strong">See all</a>
            </div> --}}
        </section>

        <br>
        <hr>
        <br>

        <!-- Tips Section -->
        <section>
            <div class="flex-left" style="justify-content: space-between;">
                <h2>{{ __("Word to the Wise") }}</h2>
                {{-- <a href="./business_tips.php">See more</a> --}}
            </div>
            <div class="tips">
                @if(isset($tips))
                    @foreach($tips as $tip)
                        <div class="card border-l-yellow">
                            <div class="flex flex-column align-items-left">
                                <div>
                                    <span class="quotes">"</span><strong>
                                        {{ $tip['tip_content'] }}
                                    </strong><span class="quotes">"</span>
                                </div>
                                <div class="flex ml-auto tip-footer" style="gap: 10px; ">
                                    <a class="tip-author" href="/user/{{ $tip['user']['user_id'] }}" style="margin: 0;">{{ $tip['user']['full_name'] }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="flex" style="justify-content: space-between; padding: 0 15px">
                <a href="/business/tips/{{ $biz['business_id'] }}" class="strong">{{ __("See all") }}</a>
            </div>
        </section>

        <br>
        <hr>
        <br>

        <!-- Location & Hours section -->
        <section>
            <div>
                <h2>{{ __("Location & Hours") }}</h2>
                <div class="flex-left" style="gap:20px;">
                    <div>
                        <div class="" style="height: 80%; width:500px; margin-right:20px;"><iframe frameborder="0"
                                style="border:0; width:100%; height:100%;"
                                src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0Dx_boXQiwvdz8sJHoYeZNVTdoWONYkU&amp;q=place_id:EntLYW5ha2FwdXJhIFJkLCBKUCBOYWdhciA2dGggUGhhc2UsIEtyaXNobmEgRGV2YXJheWEgTmFnYXIsIFllbGFjaGVuYWhhbGxsaSwgS3VtYXJhc3dhbXkgTGF5b3V0LCBCZW5nYWx1cnUsIEthcm5hdGFrYSwgSW5kaWEiLiosChQKEglTQD7jdxWuOxHVyhgiZUBnDxIUChIJuczhjGcVrjsR8l2WW9YHnZw&key=AIzaSyA0Dx_boXQiwvdz8sJHoYeZNVTdoWONYkU"
                                allowfullscreen=""></iframe></div>
                        <p class="strong" style="margin-bottom: 0;">{{ $biz['business_address'] }}</p>
                        <p style="margin-top: 0;">{{ $biz['city_id'] }}</p>
                    </div>
                    <div>
                        <table>
                            <tr style="padding: 6px;">
                                <td class="strong">
                                    {{ __("Monday") }}
                                </td>
                                <td>
                                    {{ __("Open 24 hours") }}
                                </td>
                            </tr>
                            <tr style="padding: 6px;">
                                <td class="strong">
                                    {{ __("Tuesday") }}
                                </td>
                                <td>
                                    {{ __("Open 24 hours") }}
                                </td>
                            </tr>
                            <tr style="padding: 6px;">
                                <td class="strong">
                                    {{ __("Wednesday") }}
                                </td>
                                <td>
                                    {{ __("Open 24 hours") }}
                                </td>
                            </tr>
                            <tr style="padding: 6px;">
                                <td class="strong">
                                    {{ __("Thursday") }}
                                </td>
                                <td>
                                    {{ __("Open 24 hours") }}
                                </td>
                            </tr>
                            <tr style="padding: 6px;">
                                <td class="strong">
                                    {{ __("Friday") }}
                                </td>
                                <td>
                                    {{ __("Open 24 hours") }}
                                </td>
                            </tr>
                            <tr style="padding: 6px;">
                                <td class="strong">
                                    {{ __("Saturday") }}
                                </td>
                                <td>
                                    4:00 PM - 11:00 PM
                                </td>
                            </tr>
                            <tr style="padding: 6px;">
                                <td class="strong">
                                    {{ __("Sunday") }}
                                </td>
                                <td>
                                    4:00 PM - 11:00 PM
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </section>

        <br>
        <hr>
        <br>

        <!-- Question & Answers section -->
        <!-- <section>
            <div>
                <div class="flex-left" style="justify-content: space-between;">
                    <h2>Ask the Community</h2>
                    <a href="#" class="strong" style="font-size: 18px;">Ask a question +</a>
                </div>
                <div>

                </div>
            </div>
        </section>

        <br>
        <hr>
        <br> -->

        <!-- Reviews Section -->
        <section id="review-section">
            <div>
                <div class="flex-left" style="justify-content: space-between;">
                    <h2>{{ __("Reviews") }}</h2>
                </div>
                <div class="card">
                    <h3>{{ __("Leave a review") }}</h3>
                    <div class="rating flex-left" style="font-size: 20px; justify-content:space-between;">
                        <ul>
                            <li><i class="fas fa-star review-form-star"></i></li>
                            <li><i class="fas fa-star review-form-star"></i></li>
                            <li><i class="fas fa-star review-form-star"></i></li>
                            <li><i class="fas fa-star review-form-star"></i></li>
                            <li><i class="fas fa-star review-form-star"></i></li>
                        </ul>
                    </div>
                    <form action="/business/reviews/{{ $biz['business_id'] }}" method="post">
                        @csrf
                        <textarea placeholder="{{ __("Remember, be nice!") }}" id="" name="review" rows="6" cols="30"
                        style="width: 100%;" required></textarea>
                        <button type="submit" class="btn">{{ __("SUBMIT") }}</button>
                    </form>
                </div>
                @if(isset($reviews))
                @foreach($reviews as $review)
                <div class="card">
                    <div class="review-card-header flex-left">
                        <img id=""
                            src="{{ URL::asset('upload/user_dp/') }}/{{ $review['user']['dp'] }}"
                            alt="profile" class="review-card-user-img">
                        <div>
                            <h3>{{ $review['user']['full_name'] }}</h3>
                            <p class="wander-green">{{ $review['user']['profession']  }}</p>
                        </div>
                    </div>
                    <div class="rating flex-left" style="font-size: 20px; align-items:center;">
                        <ul>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="far fa-star"></i></li>
                        </ul>
                        <p style="font-size: 14px;">{{ $review['created_at'] }}</p>
                    </div>
                    <p>
                        {{ $review['review_content'] }}
                    </p>
                </div>
                @endforeach
            @endif

            </div>
            <a href="/business/reviews/{{ $biz['business_id'] }}" class="flex-center">{{ __("See all") }}</a>
        </section>
    </div>

    <br>

@endsection
