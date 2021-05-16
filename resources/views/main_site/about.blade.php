<!--
Author: Manjunatha, Angad Tarikere
ID: 1001718335
-->

@extends('layouts.app')

@section('title', 'Diaspora | About')

@section('css-imports')
<link href="{{ URL::asset('css/angad.css') }}" rel="stylesheet">
@endsection

@section('content')

    <section style="background-color: var(--primary-color); padding:60px 0;">
        <div class="container">
            <div class="flex-left" style="justify-content: space-between; align-items:center;">
                <div class="flex-column">
                    <h2 class="display-4">Welcome to Diaspora</h2>
                    <h4 class="lead text-muted">Your space, your voice, your home.</h4>
                </div>
                <img src="{{ URL::asset('img/route.png') }}" alt="hero-img" style="padding: 50px 0px; width:400px;" />
            </div>
        </div>
    </section>



    <div class="">
        <div class="container py-5">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6 order-2 order-lg-1"><i class="fas fa-map-marker-alt fa-2x mb-3 text-success"></i>
                    <h4 class="font-weight-light">Find places around you.</h4>
                    <p class="font-italic text-muted mb-4">Moved to a new city? Feel at home, find things to do around
                        you.</p>
                    <a href="/"> <button class="btn btn-success text-white">Start Now</button>
                    </a>
                </div>
                <div class="col-lg-5 px-5 mx-auto order-1 order-lg-2"><img src="{{ URL::asset('img/world.png') }}" alt=""
                        class="img-fluid mb-4 mb-lg-0">
                </div>
            </div>
            <div class="row align-items-center mb-5">
                <div class="col-lg-5 px-5 mx-auto"><img src="{{ URL::asset('img/passport.png') }}" alt=""
                        class="img-fluid mb-4 mb-lg-0"></div>
                <div class="col-lg-6"> <i class="fas fa-comments fa-2x mb-3 text-success"></i>
                    <h4 class="font-weight-light">Meet new people</h4>
                    <p class="font-italic text-muted mb-4">Diaspora is your passport to find some really cool place
                        and interact with poeple.
                    </p>
                    <a href=""> <button class="btn btn-success text-white">Chat Now</button>
                    </a>
                </div>
            </div>
            <div class="row align-items-center mb-5">
                <div class="col-lg-6 order-2 order-lg-1">
                    <i class="fas fa-list fa-2x mb-3 text-success"></i>
                    <h4 class="font-weight-light">Make a dope profile</h4>
                    <p class="font-italic text-muted mb-4">Create a profile worth showing off. Add photos and videos of
                        your exploits.</p>
                </div>
                <div class="col-lg-5 px-5 mx-auto order-1 order-lg-2"><img src="{{ URL::asset('img/profile.png') }}" alt=""
                        class="img-fluid mb-4 mb-lg-0"></div>
            </div>
        </div>

        <br>
        <br>

        <section>
            <div class="container">
                <p style=font-size:1.5rem;>Made with <i class="fas fa-heart" style="color: var(--accent-color);"></i> by
                </p>
                <div class="flex-left" style="justify-content:space-between;">
                    <div class="card flex-center">
                        <img src="{{ URL::asset('img/aneesh.jpg') }}" alt="aneesh" style="width: 200px; border-radius:100px;">
                        <p style="font-size:1.3rem;">Aneesh Melkot</p>
                    </div>
                    <div class="card flex-center">
                        <img src="{{ URL::asset('img/angad.jpeg') }}" alt="aneesh" style="width: 200px; border-radius:100px;">
                        <p style="font-size:1.3rem;">Angad Manjunath</p>
                    </div>
                    <div class="card flex-center">
                        <img src="{{ URL::asset('img/karthik.jpeg') }}" alt="aneesh"
                            style="width: 200px; border-radius:100px;">
                        <p style="font-size:1.3rem;">Karthik Natarajan</p>
                    </div>
                    <div class="card flex-center">
                        <img src="{{ URL::asset('img/gabriel.jpeg') }}" alt="aneesh"
                            style="width: 200px; border-radius:100px;">
                        <p style="font-size:1.3rem;">Gabriel Sundalkar</p>
                    </div>
                </div>
            </div>
        </section>
        <br>

    </div>

@endsection
