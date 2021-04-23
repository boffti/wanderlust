<!--
Author: Sundalkar, Gabriel Anand
ID: 1001774881
-->
@extends('layouts.admin')

@section('title', "WL | Super Admin")

@section('content')

    {{-- <?php
        if(isset($_SESSION['user'])){
            $conn = get_db_conn();
            $sql_user_count= "SELECT COUNT(*) from users";
            $users = $conn->query($sql_user_count);
            $user_count = $users->fetch_row();

            $sql_posts_count= "SELECT COUNT(*) from posts";
            $posts = $conn->query($sql_posts_count);
            $post_count = $posts->fetch_row();

            $sql_poi_count= "SELECT COUNT(*) from business";
            $poi = $conn->query($sql_poi_count);
            $poi_count = $poi->fetch_row();

            $sql_tips_count= "SELECT COUNT(*) from tips";
            $tips = $conn->query($sql_tips_count);
            $tips_count = $tips->fetch_row();
        }
    ?> --}}

    <div class="wrapper">
        <div class="flex-left space-between">
            <div class="card info-card">
                <h2><i class="fas fa-users" style="margin-right: 6px;"></i> </h2>
                <p class="text-muted">Number of users</p>
            </div>
            <div class="card info-card">
                <h2><i class="fas fa-pencil-alt" style="margin-right: 6px;"></i> </h2>
                <p class="text-muted">Number of posts</p>
            </div>
            <div class="card info-card">
                <h2><i class="fas fa-map-marker-alt" style="margin-right: 6px;"></i> </h2>
                <p class="text-muted">Places of Interest</p>
            </div>
            <div class="card info-card">
                <h2><i class="fas fa-info" style="margin-right: 6px;"></i> </h2>
                <p class="text-muted">Number of tips written</p>
            </div>
        </div>
        <div>
            <h1 class="ml-10"></h1>
            <div class="flex-left">
                <div style="flex-grow: 1;">
                    <div class="card">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
                <div>
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
                                            <a href="/city/delete/{{ $city['city_id'] }} }}/1"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="card" style="width: 500px; height:'fit_content'">
                        <div class="flex-left space-between">
                            <h3>Countries</h3>
                            <a id="btnAddCountry" href="#" class="strong"><i class="fas fa-plus-circle"></i> ADD</a>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(isset($countries))
                                @foreach($countries as $country)
                                <tr>
                                    <td>{{ $country['country_id'] }}</td>
                                    <td>{{ $country['country_name'] }}</td>
                                    <td>
                                        <a href="/country/delete/{{ $country['country_id'] }}"><i class="fas fa-trash-alt"></i></a>
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
                    <caption>Manage Continents
                        <a id="btnAddContinent" href="#" class="strong" style="float: right;"><i
                                class="fas fa-plus-circle"></i> ADD</a>
                    </caption>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($continents))
                        @foreach($continents as $continent)
                        <tr>
                            <td>{{ $continent['continent_id'] }}</td>
                            <td>{{ $continent['continent_name'] }}</td>
                            <td>
                                <a href="/continent/delete/{{ $continent['continent_id'] }}"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    @endif


                    </tbody>
                </table>
            </div>
            <div class="card">
                <table>
                    <caption>Manage Admins
                        <a id="btnAddAdmin" href="#" class="strong" style="float: right;"><i class="fas fa-plus-circle"></i> ADD</a>
                    </caption>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Country</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($admins))
                        @foreach($admins as $admin)
                        <tr>
                            <td>{{ $admin['id'] }}</td>
                            <td>{{ $admin['full_name'] }}</td>
                            <td>{{ $admin['email'] }}</td>
                            <td>{{ $admin['country_name'] }}</td>
                            <td>
                                <a href="/admin/delete/{{ $admin['id'] }}"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    @endif

                    </tbody>
                </table>
            </div>
            <div class="card">
                <table>
                    <caption>Manage Users
                    </caption>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>City</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($users))
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user['user_id'] }}</td>
                            <td>{{ $user['full_name'] }}</td>
                            <td>{{ $user['email'] }}</td>
                            <td>{{ $user['city_name'] }}</td>
                            <td>
                                <a href="/user/delete/{{ $user['user_id'] }}"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            <div class="card" style="width:'auto'">
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
                                <a href="#"><i class="fas fa-pen"></i></a>
                                <a href="/business/delete/{{ $p['business_id'] }}/1"><i class="fas fa-trash-alt"></i></a>
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
                                <a href="/posts/delete/{{ $post['post_id'] }}/1"><i class="fas fa-trash-alt"></i></a>
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
                                <a href="/tips/delete/{{ $tip['tip_id'] }}&loc=1"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            <!-- Queries -->
            <div class="card">
                <table>
                    <caption>Manage Queries</caption>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Country</th>
                            <th>Phone</th>
                            <th>Type</th>
                            <th>Query</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($queries))
                        @foreach($queries as $q)
                        <tr>
                            <td>{{ $q['first_name'] }} {{ $q['last_name'] }}</td>
                            <td>{{ $q['email'] }}</td>
                            <td>{{ $q['country'] }}</td>
                            <td>{{ $q['phone'] }}</td>
                            <td>{{ $q['type'] }}</td>
                            <td>{{ $q['query'] }}</td>
                            <td>
                                <a href="/query/delete/{{ $q['query_id'] }}"><i class="fas fa-trash-alt"></i></a>
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
                <form action="../../php/add_city.php?loc=1" method="post" class="flex-center" style="gap: 12px;">
                    <input type="text" name="city" id="add-city-text" placeholder="City Name">
                    <div class="form-control"> <select id="location-select" name="country_id" id="country_select">
                    <option value="choose" disabled selected>Select Country</option>

                                            <option value="country id">Country Name</option>

                        </select></div>
                    <div>
                        <button class="btn" type="submit">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Country Modal -->
    <div id="add-country-modal-container" class="modal-container">
        <div class="modal" id="add-country-modal">
            <div class="modal-header flex-left space-between" style="align-items: center;">
                <p style="margin-left: 12px;">Add Country</p>
                <a href="#" class="cancel" style="float: right;">x</a>
            </div>
            <div class="modal-content" style="align-items:center;">
                <form action="../../php/add_country.php" method="post" class="flex-center" style="gap: 12px;">
                    <input type="text" name="country" id="add--text" placeholder="Country Name">
                    <div class="form-control"> <select id="location-select" name="continent_id" id="location">
                    <option value="choose" disabled selected>Select Continent</option>

                                            <option value="continent id">continent name</option>

                        </select></div>
                    <div>
                        <button class="cancel btn btn-outline-secondary text-secondary">Cancel</button>
                        <button class="btn" type="submit">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Continent Modal -->
    <div id="add-continent-modal-container" class="modal-container">
        <div class="modal" id="add-continent-modal">
            <div class="modal-header flex-left space-between" style="align-items: center;">
                <p style="margin-left: 12px;">Add Continent</p>
                <a href="#" class="cancel" style="float: right;">x</a>
            </div>
            <div class="modal-content" style="align-items:center;">
                <form action="../../php/add_continent.php" method="post" class="flex-center" style="gap: 12px;">
                    <input type="text" name="continent" id="add-continent-text" placeholder="Continent Name">
                    <div>
                        <button class="btn" type="submit">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Admin Modal -->
    <div id="add-admin-modal-container" class="modal-container">
        <div class="modal" id="add-admin-modal">
            <div class="modal-header flex-left space-between" style="align-items: center;">
                <p style="margin-left: 12px;">Add Admin</p>
                <a href="#" class="cancel" style="float: right;">x</a>
            </div>
            <div class="modal-content" style="align-items:center;">
                <form action="../../php/add_admin.php" method="post" class="flex-center" style="gap: 12px;">
                    <input type="text" name="admin_email" id="add-continent-text" placeholder="Admin Email">
                    <div class="form-control"> <select id="location-select" name="country_id" id="country_select">
                    <option value="choose" disabled selected>Select Country</option>

                                            <option value="country id">Country Name</option>

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
                <form action="../../php/add_business.php" method="post" class="flex-center" style="gap: 12px;">
                <div class="form-control"> <select id="city_select" name="city_id">
                    <option value="choose" disabled selected>Select City</option>

                                            <option value="city id">city name</option>

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

                                            <option value="cat id">cat name</option>

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
