<!--
Author: Sundalkar, Gabriel Anand
ID: 1001774881
-->
@extends('layouts.admin')

@section('title', "DS | ". session('admin')['country_name'] ." Admin")

@section('content')

    <div class="wrapper">
        <div class="flex-left space-between">
            <div class="card info-card">
                <h2><i class="fas fa-users" style="margin-right: 6px;"></i> {{ $user_count }}</h2>
                <p class="text-muted">Number of users</p>
            </div>
            <div class="card info-card">
                <h2><i class="fas fa-pencil-alt" style="margin-right: 6px;"></i> {{ count($posts) }}</h2>
                <p class="text-muted">Number of posts</p>
            </div>
            <div class="card info-card">
                <h2><i class="fas fa-map-marker-alt" style="margin-right: 6px;"></i> {{ count($poi) }}</h2>
                <p class="text-muted">Places of Interest</p>
            </div>
            <div class="card info-card">
                <h2><i class="fas fa-info" style="margin-right: 6px;"></i> {{ count($tips) }}</h2>
                <p class="text-muted">Number of tips written</p>
            </div>
        </div>
        <div>
            <h1 class="ml-10">Manage {{ session('admin')['country_name'] }}</h1>
            <div class="flex-left">
                <div style="flex-grow: 1;">
                    <div class="card">
                        <canvas id="myChart3"></canvas>
                    </div>
                </div>
                <div>
                    <div class="flex-left space-between">
                        <div class="card" style="width: 100%">
                            <h3>Statistic 2</h3>
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                    <div class="card" style="width: 500px; height:'fit_content'">
                        <div class="flex-left space-between">
                            <h3>Cities</h3>
                            <a id="btnAddCity" href="#" class="strong"><i class="fas fa-plus-circle"></i> ADD</a>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if(isset($cities))
                                @foreach($cities as $city)
                                    <tr>
                                        <td>{{ $city['city_name'] }}</td>
                                        <td>
                                            <a href="/city/delete/{{ $city['city_id'] }} }}/2"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                            </tbody>
                        </table>
                    </div>

                </div>

            </div>

            <div class="card">
            <table>
                    <caption>Manage Places of Interest
                        <a id="btnAddPlaceOfInterest" href="#" class="strong" style="float: right;"><i class="fas fa-plus-circle"></i> ADD</a>
                    </caption>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Category</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if(isset($poi))
                        @foreach($poi as $p)
                        <tr>
                            <td>{{ $p['business_name'] }}</td>
                            <td>{{ $p['business_phone'] }}</td>
                            <td>{{ $p['business_address'] }}</td>
                            <td>{{ $p['city_name'] }}</td>
                            <td>{{ $p['category_name'] }}</td>
                            <td>
                                {{-- <a href="#"><i class="fas fa-pen"></i></a> --}}
                                <a href="/business/delete/{{ $p['business_id'] }}/2"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>

            <div class="card">
            <table>
                    <caption>Manage Posts</caption>
                    <thead>
                        <tr>
                            <th>City</th>
                            <th>User</th>
                            <th>Post Content</th>
                            <th>Timestamp</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if(isset($posts))
                        @foreach($posts as $post)
                        <tr>
                            <td>{{ $post['city_name'] }}</td>
                            <td>{{ $post['full_name'] }}</td>
                            <td>{{ $post['post_content'] }}</td>
                            <td>{{ $post['created_at'] }}</td>
                            <td>
                                <a href="/post/delete/{{ $post['post_id'] }}/2"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    @endif

                    </tbody>
                </table>
            </div>

            <div class="card">
            <table>
                    <caption>Manage Tips</caption>
                    <thead>
                        <tr>
                            <th>City</th>
                            <th>User</th>
                            <th>Tip</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if(isset($tips))
                        @foreach($tips as $tip)
                        <tr>
                            <td>{{ $tip['city_name'] }}</td>
                            <td>{{ $tip['full_name'] }}</td>
                            <td>{{ $tip['tip_content'] }}</td>
                            <td>
                                <a href="/tip/delete/{{ $tip['tip_id'] }}/2"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add City Modal -->
    <div id="add-city-modal-container" class="modal-container">
        <div class="modal" id="add-city-modal">
            <div class="modal-header flex-left space-between" style="align-items: center;">
                <p style="margin-left: 12px;">Add City</p>
                <a href="#" class="cancel" style="float: right;">x</a>
            </div>
            <div class="modal-content" style="align-items:center;">
                <form action="/city/2" method="post" class="flex-center" style="gap: 12px;">
                    <input type="text" name="city" id="add-city-text" placeholder="City Name">
                    <div class="form-control"> <select id="location-select" name="country_id" id="country_select">
                    <option value="choose" disabled selected>Select Country</option>
                    @if(isset($countries))
                    @foreach($countries as $country)
                    <option value="{{ $country['country_id'] }}">{{ $country['country_name'] }}</option>
                    @endforeach
                @endif

                        </select></div>
                    <div>
                        <button class="btn" type="submit">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add POI Modal -->
    <div id="add-poi-modal-container" class="modal-container">
        <div class="modal" id="add-poi-modal">
            <div class="modal-header flex-left space-between" style="align-items: center;">
                <p style="margin-left: 12px;">Add Place of Interest</p>
                <a href="#" class="cancel" style="float: right;">x</a>
            </div>
            <div class="modal-content" style="align-items:center;">
                <form action="/business/2" method="post" class="flex-center" style="gap: 12px;">
                    @csrf
                <div class="form-control"> <select id="city_select" name="city_id">
                    <option value="choose" disabled selected>Select City</option>
                        @if(isset($cities))
                        @foreach($cities as $city)
                            <option value="{{ $city['city_id'] }}">{{ $city['city_name'] }}</option>
                        @endforeach
                        @endif
                        </select></div>
                    <input type="text" name="businessName" id="businessName" placeholder="Place Name">
                    <textarea name="businessDesc" id="businessDesc" cols="30" rows="3" placeholder="Place Description"
                        style="width: 400px;"></textarea>
                    <input type="text" name="businessWebsite" id="businessWebsite" placeholder="Website Link">
                    <input type="text" name="businessPhone" id="businessPhone" placeholder="Phone">
                    <input type="text" name="businessAddress" id="businessAddress" placeholder="Address">
                    <input type="text" name="photoURI" id="photoURI" placeholder="Photo Link">

                    <div class="form-control"> <select name="category_id" id="category_id">
                            <option value="choose" disabled selected>Choose a Category</option>
                            @if(isset($categories))
                            @foreach($categories as $cat)
                                <option value="{{ $cat['category_id'] }}">{{ $cat['category_name'] }}</option>
                            @endforeach
                            @endif
                        </select></div>
                    <div>
                        <div>
                            <button class="btn" type="submit">Add</button>
                        </div>
                </form>
            </div>
        </div>
    </div>

@endsection
