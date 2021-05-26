<!--
    Author: Melkot, Aaneesh Naagaraj
    ID : 1001750503
-->
@extends('layouts.white')

@section('title', 'DS | ' . session('user_loc')['city_name'] . " Tips" )

@section('content')

    <div class="container">
    <h2>{{ __("Tips in and around") }} {{ session('user_loc')['city_name'] }}</h2>
        @if(in_array('1', session('user_roles')))
        <form action="/tip" method="POST">
            @csrf
            <div class="flex-left">
                <textarea placeholder="Write a tip. Type here..." name="tip" id="bulletin_post" cols="30" rows="3"
                    style="width: 100%; padding:12px; margin: 12px" class="card" required></textarea>
                <div class="card">
                    <p>{{ __("Write a tip to help other people. It can be about anything you've seen or heard.") }}</p>
                </div>
            </div>
            <button type="submit" class="btn" style="margin:0 12px;">{{ __("SUBMIT") }}</button>
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
                            <a class="tip-author" href="{{ $tip['user']['user_id'] }}" style="margin: 0;">{{ $tip['user']['full_name'] }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        </div>
    </div>
    <br>

 @endsection
