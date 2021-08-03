<!--
Author: Natarajan, Karthik
ID: 1001872904
-->
@extends('layouts.app', ['page'=> 'visitor_services'])

@section('title', 'Diaspora | Visitor Services')

@section('css-imports')
<link href="{{ URL::asset('css/angad.css') }}" rel="stylesheet">
@endsection

@section('content')

    <section style="background-color: var(--primary-color); padding:20px 0;">
        <div class="container">
            <div class="flex-left" style="justify-content: space-between; align-items:center;">
                <div class="col-lg-6">
                    <h2 class="display-4">{{ __("Visitor Services") }}</h2>
                </div>
                <img src="{{ URL::asset('img/visitor.png') }}" alt="hero-img" style="padding: 50px 0px; width:300px;" />
            </div>
        </div>
    </section>

    <br>

    <section class="container">
        <ul class="c-services">
            <div class="card bb-green">
                <li class="c-services__item">
                    <h3><i class="fas fa-list fa-1x mb-2 text-success"></i>&nbsp {{ __("Find things to do") }}</h3>
                    <p>{{ __("We provide you with the latest and established categories of businesses in the selected locality, personalized for you, to match your requirements.") }}</p>
                </li>
            </div>
            <div class="card bb-green">
                <li>
                    <h3><i class="fas fa-blog fa-1x mb-3 text-success"></i>&nbsp {{ __("Blog") }}</h3>
                    <p>{{ __("It’s time for you to write your best blog. We provide you with the access/feature to write about your opinions and feelings about the businesses or attractions you recently visited or already familiar  with. Help the visitors familiarize with the city or the local area by helping them gain more information from your blog") }}</p>
                </li>
            </div>
            <div class="card bb-green">
                <li>
                    <h3><i class="fas fa-book-open a-1x mb-3 text-success"></i>&nbsp {{ __("Review and Tips") }}</h3>
                    <p>{{ __("Give and, Receive too. Leave Reviews and Tips on Diaspora. Help users across the globe get familiar with the place they are located in. Providing reviews and giving tips about a certain location or the businesses attached to it will be a great benefit to all the users who are on the, look out for more quality information about their favorite spots!") }}</p>
                </li>
            </div>
            <div class="card bb-green">
                <li class="c-services__item">
                    <h3><i class="fas fa-comments fa-1x mb-3 text-success"></i>&nbsp {{ __("Chat") }}</h3>
                    <p>{{ __("A personalized chat room for the users! Users can come together to discuss and provide information to those seeking. Provides an interface where users can chat one- to- one or many -to- many. Helps in bringing our Diaspora community together.") }}</p>
                </li>
            </div>
        </ul>
    </section>

    <br>

@endsection
