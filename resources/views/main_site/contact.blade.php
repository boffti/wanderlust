<!--
Author: Natarajan, Karthik
ID: 1001872904
-->
@extends('layouts.app')

@section('title', 'Diaspora | About')

@section('css-imports')
<link href="{{ URL::asset('css/karthik.css') }}" rel="stylesheet">
@endsection

@section('content')

    <section style="background-color: var(--primary-color); padding:60px 0;">
        <div class="container">
            <div class="flex-center" style="justify-content: space-between; align-items:center;">
                <h2 class="display-4">{{ __("We'd love to hear from you. Please reach out to us with any queries.") }}</h2>
            </div>
        </div>
    </section>
    <br>

    <!-- Contact Form -->
    <div class="container">
        <div class="card">
            <form action="{{ route('sendQuery', app()->getLocale()) }}" method="POST">
                @csrf
                <h3>Contact us</h3>
                <div class="flex-left" style="justify-content: space-around;">
                    <div style="width: 100%;">
                        <input type="text" name="firstName" id="" placeholder="{{ __("First name") }}" required>
                        <input type="text" name="country" id="" placeholder="{{ __("Country") }}" required>
                        <input type="text" name="phone" id="" placeholder="{{ __("Phone") }}" pattern=[0-9]{10}>
                    </div>
                    <div style="width: 100%;">
                        <input type="text" name="lastName" id="" placeholder="{{ __("Last name") }}" required>
                        <input type="text" name="email" id="" placeholder="{{ __("Email") }}" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
                        <input type="text" name="userType" id="" placeholder="{{ __("Immigrant/Visitor") }}">
                    </div>
                </div>
                <textarea placeholder="Query" id="" name="query" rows="6" cols="30" required></textarea>
                <button type="submit" class="btn btn-submit">{{ __("SUBMIT") }}</button>
            </form>
        </div>
    </div>

    <br>

    <div class="content-wrap">
        <div class="map-wrap">
            <iframe frameborder="0" height="300"
                src="https://maps.google.com/maps?q=w%20mitchell%20st&t=&z=13&ie=UTF8&iwloc=&output=embed"
                style="border:0" width="100%"></iframe>
        </div>
    </div>

@endsection
