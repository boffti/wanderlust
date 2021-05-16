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
                        placeholder="Keywords eg: food, salons, shopping etc">
                </div>
                <div class="form-control"> <select name="categories" id="categories">
                        <option value="choose" disabled selected>Choose a Category</option>
                        <option value="restaurants">Restaurants</option>
                        <option value="shopping">Shopping</option>
                        <option value="education">Education</option>
                        <option value="worship">Religion & Worship</option>
                        <option value="entertainment">Entertainment</option>
                        <option value="health">Health & Medical</option>
                    </select>
                </div>
                <button id="btnSearchNow" type="submit" href="#" class="btn" style="margin-left: 25px;">SEARCH
                    NOW</button>
            </form>
        </section>
        <br>

        <!-- Busness Header -->
        <section>
            <div class="flex-left" style="justify-content: space-between;">
                <div>
                    <h1 class="strong business-name" style="font-size: 45px; margin-bottom:0;">{{ $biz['business_name'] }}</h1>
                    <div class="rating flex-left" style="font-size: 40px; align-items:center;">
                        <ul style="padding-left:0;">
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="far fa-star"></i></li>
                        </ul>
                        <span class="rating-count">{{ count($reviews) }} reviews</span>
                    </div>
                    <p class="business-category"></p>
                    <div class="business-timings">
                        <span style="color: var(--other-color-1); font-weight:bold; margin-right:10px;">Open</span> Open
                        24
                        hours
                    </div>
                    <br>
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

        <!-- Reviews Section -->
        <section>
            <div>
                <div class="flex-left" style="justify-content: space-between;">
                    <h2>Reviews</h2>
                </div>
                <div class="card">
                    <h3>Leave a review</h3>
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
                        <textarea placeholder="Remember, be nice!" id="" name="review" rows="6" cols="30"
                        style="width: 100%;" required></textarea>
                        <button type="submit" class="btn">SUBMIT</button>
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
        </section>
    </div>
    <br>

@endsection
