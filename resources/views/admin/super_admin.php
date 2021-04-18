<?php session_start(); 
include '../../php/functions.php';
?>
<!-- 
Author: Sundalkar, Gabriel Anand
ID: 1001774881
-->
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>WL | Super Admin </title>
    <link rel="shortcut icon" href="../../static/favicon.ico" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />

    <link rel="stylesheet" href="../../static/css/style.css">
    <link rel="stylesheet" href="../../static/css/gabriel.css">

<body>
    <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <div id="navbar" class="navbar navbar-wander-green">
        <div class="container flex">
            <h1>Wanderlust</h1>
            <nav>
                <ul>
                    <li><a href="../../index.php">Home</a></li>
                    <li><a href="../main_site/about.php">About</a></li>
                    <li class="dropdown">
                        <a href="#" class="">Services <i class="fas fa-angle-down" style="margin-left: 5px;"></i>
                        </a>
                        <ul class="dropdown-content">
                            <li><a class="dropdown-item" href="../main_site/immigrant_services.php">Immigrant
                                    Services</a></li>
                            <li><a class="dropdown-item" href="../main_site/visitor_service.php">Visitor
                                    Services</a></li>
                        </ul>
                    </li>
                    <li><a href="/blog">Blog</a></li>
                    <li><a href="../main_site/contact.php">Contact</a></li>
                </ul>
            </nav>

            <!-- ! If user not in session -->
            <!-- <div class="signup">
                    <button class="btn btn-outline-secondary">Login / Signup</button>
                </div> -->

            <!-- ! If user in session -->
            <?php 
            if(isset($_SESSION['user'])) {
                if(in_array('3', $_SESSION['user_roles'])) {
                    $admin_markup = <<<am
                    <!-- ! If Role == Admin -->
                    <li class="dropdown-item">
                        <a href="./country_admin.php">
                            <i class="fas fa-tools" style="margin-right: 8px;"></i>
                            Admin Console
                        </a>
                    </li>
                    am;
                } else {
                    $admin_markup = "";
                }

                if(in_array('4', $_SESSION['user_roles'])) {
                    $super_admin_markup = <<<sam
                    <!-- ! If Role == SuperAdmin -->
                    <li class="dropdown-item">
                        <a href="./super_admin.php">
                            <i class="fas fa-toolbox" style="margin-right: 8px;"></i>
                            Super Admin Console
                        </a>
                    </li>
                    <!-- ! Endif -->
                    sam;
                } else {
                    $super_admin_markup = "";
                }

                $dp = $_SESSION['user']['dp'];
                            
                echo <<<heredoc
                <!-- ! If user in session -->
                <ul class="hidden">
                    
                    <li class="dropdown">
                        <a href="#" class="profile flex">
                            <img id="avatarIMG" src="../../static/upload/user_dp/{$dp}" alt="profile" class="">
                            <p id="" class="">
                                {$_SESSION['user']['full_name']}
                            </p>
                            <i class="fas fa-angle-down" style="margin-left: 8px;"></i>
                        </a>
                        <ul class="dropdown-content" style="top:50px">
                            <li class="dropdown-item">
                                <a href="../user/profile.php">
                                    <i class="fas fa-user" style="margin-right: 8px;"></i>
                                    My Profile
                                </a>
                            </li>
                            {$admin_markup}
                            {$super_admin_markup}
                            <li class="dropdown-item">
                                <a href="../../php/logout.php">
                                    <i class="fas fa-sign-out-alt" style="margin-right: 8px;"></i>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul> 
                heredoc;
            } else {
                echo '<div class="signup">
                            <a href="../login/login.php">
                                <button class="btn btn-outline-accent text-accent">Login / Signup</button>
                            </a>
                        </div>';
            }
            ?>
            <a href="#" class="menu-icon"><i class="fas fa-bars"></i></a>
        </div>
    </div>

    <nav class="sidenav">
        <ul class="sidenav-list">
            <li class="sidenav-list-item"><i class="fas fa-home" style="margin-right: 20px;"></i> Home</li>
            <li class="sidenav-list-item"><i class="fas fa-hand-holding-heart" style="margin-right: 20px;"></i>
                Contributions</li>
            <li class="sidenav-list-item"><i class="fas fa-map-marked-alt" style="margin-right: 20px;"></i> Places of
                Interest</li>
        </ul>
    </nav>

    <?php
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
    ?>

    <div class="wrapper">
        <div class="flex-left space-between">
            <div class="card info-card">
                <h2><i class="fas fa-users" style="margin-right: 6px;"></i> <?php echo $user_count[0] ?></h2>
                <p class="text-muted">Number of users</p>
            </div>
            <div class="card info-card">
                <h2><i class="fas fa-pencil-alt" style="margin-right: 6px;"></i> <?php echo $post_count[0] ?></h2>
                <p class="text-muted">Number of posts</p>
            </div>
            <div class="card info-card">
                <h2><i class="fas fa-map-marker-alt" style="margin-right: 6px;"></i> <?php echo $poi_count[0] ?></h2>
                <p class="text-muted">Places of Interest</p>
            </div>
            <div class="card info-card">
                <h2><i class="fas fa-info" style="margin-right: 6px;"></i> <?php echo $tips_count[0] ?></h2>
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
                            <?php 
                                $conn = get_db_conn();
                                $sql_get_cities = "SELECT city_id, city_name from cities";
                                $cities = $conn->query($sql_get_cities);
                                if($cities->num_rows > 0) {                          
                                    $html_template = "";
                                    while($item = $cities->fetch_assoc()) {
                                        echo <<<cities
                                        <tr>
                                            <td>{$item['city_name']}</td>
                                            <td>
                                                <a href="../../php/delete_city.php?id={$item['city_id']}&loc=1"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                        cities;
                                    }
                                }
                            ?>
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
                            <?php 
                                $conn = get_db_conn();
                                $sql_get_countries = "SELECT country_id, country_name from countries";
                                $countries = $conn->query($sql_get_countries);
                                if($countries->num_rows > 0) {                          
                                    $html_template = "";
                                    while($item = $countries->fetch_assoc()) {
                                        echo <<<countries
                                        <tr>
                                            <td>{$item['country_id']}</td>
                                            <td>{$item['country_name']}</td>
                                            <td>
                                                <a href="../../php/delete_country.php?id={$item['country_id']}"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                        countries;
                                    }
                                }
                            ?>
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
                        <?php 
                            $conn = get_db_conn();
                            $sql_get_continents = "SELECT continent_id, continent_name from continents";
                            $continents = $conn->query($sql_get_continents);
                            if($continents->num_rows > 0) {                          
                                $html_template = "";
                                while($item = $continents->fetch_assoc()) {
                                    echo <<<continents
                                    <tr>
                                        <td>{$item['continent_id']}</td>
                                        <td>{$item['continent_name']}</td>
                                        <td>
                                            <a href="../../php/delete_continent.php?id={$item['continent_id']}"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    continents;
                                }
                            }
                        ?>
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
                        <?php 
                            $conn = get_db_conn();
                            $sql_get_admins = "SELECT users.user_id, users.full_name, users.email, countries.country_id, countries.country_name from users, country_admins, countries where users.user_id=country_admins.user_id and country_admins.country_id=countries.country_id";
                            $admins = $conn->query($sql_get_admins);
                            if($admins->num_rows > 0) {                          
                                while($item = $admins->fetch_assoc()) {
                                    echo <<<admins
                                    <tr>
                                        <td>{$item['user_id']}</td>
                                        <td>{$item['full_name']}</td>
                                        <td>{$item['email']}</td>
                                        <td>{$item['country_name']}</td>
                                        <td>
                                            <a href="../../php/delete_admin.php?id={$item['user_id']}"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    admins;
                                }
                            }
                        ?>
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
                            <th>Number</th>
                            <th>Email</th>
                            <th>Country</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $conn = get_db_conn();
                            $sql_get_users = "SELECT users.user_id, users.full_name, users.email, cities.city_id, cities.city_name, countries.country_id, countries.country_name from users, cities, countries where users.city=cities.city_id and cities.country_id=countries.country_id";
                            $users = $conn->query($sql_get_users);
                            if($users->num_rows > 0) {                          
                                while($item = $users->fetch_assoc()) {
                                    echo <<<users
                                    <tr>
                                        <td>{$item['user_id']}</td>
                                        <td>{$item['full_name']}</td>
                                        <td>{$item['email']}</td>
                                        <td>{$item['city_name']}</td>
                                        <td>{$item['country_name']}</td>
                                        <td>
                                            <a href="../../php/delete_user.php?id={$item['user_id']}"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    users;
                                }
                            }
                        ?>
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
                        <?php 
                            $conn = get_db_conn();
                            $sql_get_poi = "SELECT b.business_id, b.business_name, b.business_website, b.business_desc, b.business_phone, b.business_address, b.photo_uri, c.city_id, c.city_name, cat.category_id, cat.category_name from business as b, cities as c, categories as cat where b.city_id=c.city_id and b.category=cat.category_id";
                            $pois = $conn->query($sql_get_poi);
                            if($pois->num_rows > 0) {                          
                                while($item = $pois->fetch_assoc()) {
                                    echo <<<pois
                                    <tr>
                                        <td>{$item['business_name']}</td>
                                        <td>{$item['business_phone']}</td>
                                        <td>{$item['business_address']}</td>
                                        <td>{$item['city_name']}</td>
                                        <td>{$item['category_name']}</td>
                                        <td>
                                            <a href="#"><i class="fas fa-pen"></i></a>
                                            <a href="../../php/delete_poi.php?id={$item['business_id']}&loc=1"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    pois;
                                }
                            }
                        ?>
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
                        <?php 
                            $conn = get_db_conn();
                            $sql_get_posts = "SELECT p.post_id, p.post_content, p.created_at, u.full_name, c.city_name from posts as p, users as u, cities as c where p.user_id=u.user_id and p.city_id=c.city_id";
                            $posts = $conn->query($sql_get_posts);
                            if($posts->num_rows > 0) {                          
                                while($item = $posts->fetch_assoc()) {
                                    echo <<<users
                                    <tr>
                                        <td>{$item['city_name']}</td>
                                        <td>{$item['full_name']}</td>
                                        <td>{$item['post_content']}</td>
                                        <td>{$item['created_at']}</td>
                                        <td>
                                            <a href="../../php/delete_post.php?id={$item['post_id']}&loc=2"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    users;
                                }
                            }
                        ?>
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
                    <?php 
                            $conn = get_db_conn();
                            $sql_get_tips = "SELECT t.tip_id, t.tip_content, u.full_name, c.city_name from tips as t, users as u, cities as c where t.user_id=u.user_id and t.city_id=c.city_id";
                            $tips = $conn->query($sql_get_tips);
                            if($tips->num_rows > 0) {                          
                                while($item = $tips->fetch_assoc()) {
                                    echo <<<users
                                    <tr>
                                        <td>{$item['city_name']}</td>
                                        <td>{$item['full_name']}</td>
                                        <td>{$item['tip_content']}</td>
                                        <td>
                                            <a href="../../php/delete_tip.php?tip_id={$item['tip_id']}&loc=1"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    users;
                                }
                            }
                        ?>
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
                    <?php 
                            $conn = get_db_conn();
                            $sql_get_queries = "SELECT query_id, first_name, last_name, country, email, phone, type, query from contact_form";
                            $queries = $conn->query($sql_get_queries);
                            if($queries->num_rows > 0) {                          
                                while($item = $queries->fetch_assoc()) {
                                    echo <<<users
                                    <tr>
                                        <td>{$item['first_name']}</td>
                                        <td>{$item['email']}</td>
                                        <td>{$item['country']}</td>
                                        <td>{$item['phone']}</td>
                                        <td>{$item['type']}</td>
                                        <td>{$item['query']}</td>
                                        <td>
                                            <a href="../../php/delete_query.php?id={$item['query_id']}&loc=1"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    users;
                                }
                            }
                        ?>
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
                            <?php
                                if(isset($_SESSION['user'])){
                                    $sql_country_options= "SELECT country_id, country_name from countries";
                                    $countries = $conn->query($sql_country_options);
                                    if($countries->num_rows > 0) {                          
                                        while($item = $countries->fetch_assoc()) {
                                            echo <<<explore
                                            <option value="{$item['country_id']}">{$item['country_name']}</option>
                                            explore;
                                        }
                                    }
                                   }
                            ?>
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
                            <?php
                                if(isset($_SESSION['user'])){
                                    $sql_cont_options= "SELECT continent_id, continent_name from continents";
                                    $conts = $conn->query($sql_cont_options);
                                    if($conts->num_rows > 0) {                          
                                        while($item = $conts->fetch_assoc()) {
                                            echo <<<explore
                                            <option value="{$item['continent_id']}">{$item['continent_name']}</option>
                                            explore;
                                        }
                                    }
                                   }
                            ?>
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
                            <?php
                                if(isset($_SESSION['user'])){
                                    $sql_country_options= "SELECT country_id, country_name from countries";
                                    $countries = $conn->query($sql_country_options);
                                    if($countries->num_rows > 0) {                          
                                        while($item = $countries->fetch_assoc()) {
                                            echo <<<explore
                                            <option value="{$item['country_id']}">{$item['country_name']}</option>
                                            explore;
                                        }
                                    }
                                   }
                            ?>
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
                            <?php
                                if(isset($_SESSION['user'])){
                                    $sql_city= "SELECT city_id, city_name from cities";
                                    $cities = $conn->query($sql_city);
                                    if($cities->num_rows > 0) {                          
                                        while($item = $cities->fetch_assoc()) {
                                            echo <<<explore
                                            <option value="{$item['city_id']}">{$item['city_name']}</option>
                                            explore;
                                        }
                                    }
                                   }
                            ?>
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
                            <?php
                                if(isset($_SESSION['user'])){
                                    $sql_cat= "SELECT category_id, category_name from categories";
                                    $categories = $conn->query($sql_cat);
                                    if($categories->num_rows > 0) {                          
                                        while($item = $categories->fetch_assoc()) {
                                            echo <<<explore
                                            <option value="{$item['category_id']}">{$item['category_name']}</option>
                                            explore;
                                        }
                                    }
                                   }
                            ?>
                        </select></div>
                    <div>
                        <div>
                            <button class="btn" type="submit">Add</button>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <?php
        $conn = get_db_conn();

        $city_options = "";
        $category_options = "";

        $sql_city= "SELECT city_id, city_name from cities";
        $cities = $conn->query($sql_city);
        if($cities->num_rows > 0) {                          
            while($item = $cities->fetch_assoc()) {
                $city_options .= <<<explore
                <option value="{$item['city_id']}">{$item['city_name']}</option>
                explore;
            }
        }

        $sql_cat= "SELECT category_id, category_name from categories";
        $categories = $conn->query($sql_cat);
        if($categories->num_rows > 0) {                          
            while($item = $categories->fetch_assoc()) {
                $category_options .= <<<explore
                <option value="{$item['category_id']}">{$item['category_name']}</option>
                explore;
            }
        }

        $sql_get_poi = "SELECT b.business_id, b.business_name, b.business_website, b.business_desc, b.business_phone, b.business_address, b.photo_uri, c.city_id, c.city_name, cat.category_id, cat.category_name from business as b, cities as c, categories as cat where b.city_id=c.city_id and b.category=cat.category_id";
        $pois = $conn->query($sql_get_poi);
        if($pois->num_rows > 0) {                          
            while($item = $pois->fetch_assoc()) {
                echo <<<pois
                <div id="add-poi-modal-container" class="modal-container">
                <div class="modal" id="poi_{$item['business_id']}">
                    <div class="modal-header flex-left space-between" style="align-items: center;">
                        <p style="margin-left: 12px;">Add Place of Interest</p>
                        <a href="#" class="cancel" style="float: right;">x</a>
                    </div>
                    <div class="modal-content" style="align-items:center;">
                        <form action="../../php/add_business.php" method="post" class="flex-center" style="gap: 12px;">
                        <div class="form-control"> <select id="city_select" name="city_id">
                            <option value="choose" disabled selected>Select City</option>
                                    {$city_options}
                                </select></div>
                            <input type="text" name="businessName" id="businessName" value="{$item['business_name']}">
                            <textarea name="businessDesc" id="businessDesc" cols="30" rows="3" value="{$item['business_desc']}"
                                style="width: 400px;"></textarea>
                            <input type="text" name="businessWebsite" id="businessWebsite" value="{$item['business_website']}">
                            <input type="text" name="businessPhone" id="businessPhone" value="{$item['business_phone']}">
                            <input type="text" name="businessAddress" id="businessAddress" value="{$item['business_address']}">
                            <input type="text" name="photoURI" id="photoURI" value="{$item['photo_uri']}">
                                        
                            <div class="form-control"> <select name="category_id" id="category_id">
                                    <option value="choose" disabled selected>Choose a Category</option>
                                    {$category_options}
                                        </select></div>
                                    <div>
                                        <div>
                                            <button class="btn" type="submit">Update</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                pois;
            }
        }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Faker/3.1.0/faker.min.js"
        integrity="sha512-/seDHxVfh1NvFUscAj8GsHQVZJvr2jjAoYsNL7As2FCaFHUHYIarl3sRCvVlFgyouVNiRgHIebyLKjpgd1SLDw=="
        crossorigin="anonymous"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="../../static/js/admin.js"></script>
</body>

</html>