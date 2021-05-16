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
                        <span class="rating-count"></span>
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

        <!-- Tips Section -->
        <section>
            <div class="flex-left" style="justify-content: space-between;">
                <h2>Word to the Wise</h2>
            </div>
            @if(in_array('1', session('user_roles')))
            <form action="/business/tips/{{ $biz['business_id'] }}" method="post">
                @csrf
                <div class="flex-left">
                    <textarea placeholder="Write a tip about {{ $biz['business_name'] }}. Type here..." name="businessTip" id="bulletin_post" cols="30" rows="3"
                        style="width: 100%; padding:12px; margin: 12px" class="card" required></textarea>
                    <div class="card">
                        <p>Write a tip to help other people. It can be about anything you've seen or heard.</p>
                    </div>
                </div>
                <button type="submit" class="btn" style="margin:0 12px;">SUBMIT</button>
            </form>
            @endif
            <br>
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
        </section>
    </div>
    <br>


    @endsection
