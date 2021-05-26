<!--
    Author: Melkot, Aaneesh Naagaraj
    ID : 1001750503
-->
@extends('layouts.white')

@section('title', 'DS | Search Results')

@section('content')

    <!-- hero -->
    <div>
        <div class="container-fluid-left">

            <div class="flex" style="gap: 12px;">
                <section id="left-section" style="flex-grow: 1.5; flex-basis: 0;">
                    <section>
                        <h2 class="">{{ __("You might like") }}</h2>
                        <div class="flex-left">
                            @if(isset($similar))
                            @foreach($similar as $item)
                            <div class="browse-card">
                                <div class="card-header">
                                    <img class="card-img"
                                        src="{{$item['photo_uri']}}"
                                        alt="">
                                </div>
                                <div class="card-body">
                                    <h1><a href="business/{{ $item['business_id'] }}">{{ $item['business_name'] }}</a></h1>
                                    <p>{{ substr($item['business_address'], 0, 25) }}</p>
                                    <div class="rating">
                                        <ul>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                            <li><i class="fas fa-star"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif


                        </div>
                    </section>

                    <section style="padding-top: 15px;">
                        <h2>{{ __("All Results") }}</h2>

                        <div class="grid grid-2">
                            @if(isset($results))
                            @foreach($results as $item)
                            <div class="card flex-left">
                                <img src="{{ $item['photo_uri'] }}"
                                    alt="" style="width: 150px; height: 150px; object-fit: cover;">
                                <div class="flex-column" style="justify-content: space-between;">
                                    <div>
                                        <div class="flex-left space-between" style="align-items: center;">
                                            <a href="business/{{ $item['business_id'] }}"><h3>{{ $item['business_name'] }}</h3></a>
                                            {{-- <p class="wander-green" style="margin: 0; font-size:14px;"> {{ substr($item['business_address'], 0, 25) }}</p> --}}
                                        </div>
                                        <div class="rating">
                                            <ul class="flex" style="padding:0; justify-content:flex-start">
                                                <li><i class="fas fa-star"></i></li>
                                                <li><i class="fas fa-star"></i></li>
                                                <li><i class="fas fa-star"></i></li>
                                                <li><i class="fas fa-star"></i></li>
                                                <li><i class="far fa-star"></i></li>
                                            </ul>
                                        </div>
                                        <p class="strong" style="font-size: 14px;">{{ substr($item['business_address'], 0, 25) }}</p>
                                    </div>
                                    <p>"{{ substr($item['business_desc'], 0, 35) }}..."</p>
                                </div>
                            </div>
                            @endforeach
                            @endif


                        </div>

                    </section>
                </section>

                <section id="right-section" style="flex-grow: 1; flex-basis: 0;">
                    <!-- MAP -->
                    <div class="card" style="height:120vh">
                        <div class="" style="height: 100%"><iframe frameborder="0"
                                style="border:0; width:100%; height:100%;"
                                src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0Dx_boXQiwvdz8sJHoYeZNVTdoWONYkU&amp;q=place_id:EntLYW5ha2FwdXJhIFJkLCBKUCBOYWdhciA2dGggUGhhc2UsIEtyaXNobmEgRGV2YXJheWEgTmFnYXIsIFllbGFjaGVuYWhhbGxsaSwgS3VtYXJhc3dhbXkgTGF5b3V0LCBCZW5nYWx1cnUsIEthcm5hdGFrYSwgSW5kaWEiLiosChQKEglTQD7jdxWuOxHVyhgiZUBnDxIUChIJuczhjGcVrjsR8l2WW9YHnZw&key=AIzaSyA0Dx_boXQiwvdz8sJHoYeZNVTdoWONYkU"
                                allowfullscreen=""></iframe></div>
                    </div>
                </section>

            </div>

        </div>
    </div>

    <br>

@endsection
