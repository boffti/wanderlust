<!-- 
    Author: Melkot, Aaneesh Naagaraj
    ID : 1001750503
-->
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>

<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="../../static/favicon.ico" />
    <title>Wanderlust | Search Results</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />
    <link href="../../static/css/style.css" rel="stylesheet">
</head>

<body>
    <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <!-- Navbar -->
    <div id="navbar" class="navbar" style="overflow: visible;">
        <div class="container-fluid flex">
            <a href="../../index.php">
                <h1>Wanderlust</h1>
            </a>
            <nav>
                <section style="margin-top: 50px;">
                    <form class="hero-form card flex" action="#">
                        <div class="flex-left flex-wrap" style="justify-content: space-between;">
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
                            <button id="btnSearchNow" type="submit" href="#" class="btn"
                                style="margin-left: 25px;">SEARCH
                                NOW</button>
                        </div>
                    </form>
                </section>
            </nav>

            <!-- <div class="signup">
                <button class="btn btn-outline-secondary">Login / Signup</button>
            </div> -->
            <?php 

                if(in_array('3', $_SESSION['user_roles'])) {
                    $admin_markup = <<<am
                    <!-- ! If Role == Admin -->
                    <li class="dropdown-item">
                        <a href="../admin/country_admin.php">
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
                        <a href="../admin/super_admin.php">
                            <i class="fas fa-toolbox" style="margin-right: 8px;"></i>
                            Super Admin Console
                        </a>
                    </li>
                    <!-- ! Endif -->
                    sam;
                } else {
                    $super_admin_markup = "";
                }
            
            if(isset($_SESSION['user'])) {
                echo <<<heredoc
                <!-- ! If user in session -->
                <ul class="hidden">
                    <li>
                        <a id="currentLocation" href="#" class="navbar-location flex">
                        <i class="fas fa-map-marker-alt loc-icon"></i>
                            {$_SESSION['user_loc']['city_name']}
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="profile flex">
                            <img id="avatarIMG" src="" alt="profile" class="avatarIMG">
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
                            <!-- ! Endif -->
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
            <a id="btnMenu" href="#" class="menu-icon"><i class="fas fa-bars"></i></a>
        </div>
    </div>
    <br>

    <!-- hero -->
    <div>
        <div class="container-fluid-left">

            <div class="flex" style="gap: 12px;">
                <section id="left-section" style="flex-grow: 1.5; flex-basis: 0;">
                    <section>
                        <h2 class="">You might like</h2>
                        <div class="flex-left">
                        <?php 
                        include '../../php/functions.php';
                        $conn = get_db_conn();
                        $sql_explore_nearby = "SELECT business.business_id, business.business_name, business.business_website, business.business_desc, business.business_phone, business.business_address, business.photo_uri, cities.city_id, cities.city_name, categories.category_name from business, cities, categories where business.city_id=cities.city_id and categories.category_id=business.category and cities.city_name='{$_SESSION['user_loc']['city_name']}' limit 3";
                        $explore_places = $conn->query($sql_explore_nearby);
                        if($explore_places->num_rows > 0) {                          
                            $html_template = "";
                            while($item = $explore_places->fetch_assoc()) {
                                echo <<<explore
                                <div class="browse-card">
                                    <div class="card-header">
                                        <img class="card-img"
                                            src="{$item['photo_uri']}"
                                            alt="">
                                    </div>
                                    <div class="card-body">
                                        <h1><a href="./pages/business/business_detail.php">{$item['business_name']}</a></h1>
                                        <p>{$item['city_name']}</p>
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
                                explore;
                            }
                        }
                    ?>
                        </div>
                    </section>

                    <section style="padding-top: 15px;">
                        <h2>All Results</h2>

                        <div class="grid grid-2">
                            <?php 
                            $sql_explore_nearby = "SELECT business.business_id, business.business_name, business.business_website, business.business_desc, business.business_phone, business.business_address, business.photo_uri, cities.city_id, cities.city_name, categories.category_name from business, cities, categories where business.city_id=cities.city_id and categories.category_id=business.category and cities.city_name='{$_SESSION['user_loc']['city_name']}'";
                            $explore_places = $conn->query($sql_explore_nearby);
                            if($explore_places->num_rows > 0) {                          
                                $html_template = "";
                                while($item = $explore_places->fetch_assoc()) {
                                    $short_desc = substr($item['business_desc'], 0, 50);
                                    echo <<<explore
                                    <div class="card flex-left">
                                        <img src="{$item['photo_uri']}"
                                            alt="" style="width: 150px; height: 150px; object-fit: cover;">
                                        <div class="flex-column" style="justify-content: space-between;">
                                            <div>
                                                <div class="flex-left space-between" style="align-items: center;">
                                                    <a href="../business/business_detail.php?business_id={$item['business_id']}"><h3>{$item['business_name']}</h3></a>
                                                    <p class="wander-green" style="margin: 0; font-size:14px;"> {$item['city_name']}</p>
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
                                                <p class="strong" style="font-size: 14px;">{$item['category_name']}</p>
                                            </div>
                                            <p>"{$short_desc}"</p>
                                        </div>
                                    </div>
                                    explore;
                                }
                            }
                            ?>
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

    <!-- Site footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="grid grid-3">
                <div class="">
                    <h6>About</h6>
                    <p class="text-justify"><i>WANDERLUST</i> is a portal for immigrants who have just moved to a new
                        location. They can use the provided services to find places of interest around them. They can
                        rate and review businesses and upload photos and videos to their profile.</p>
                </div>

                <div class="">
                    <h6>Categories</h6>
                    <ul class="footer-links">
                        <li><a href="#">Restaurants</a></li>
                        <li><a href="#">Shopping</a></li>
                        <li><a href="#">Education</a></li>
                        <li><a href="#">Religion & Worship</a></li>
                        <li><a href="#">Entertainment</a></li>
                        <li><a href="#">Health & Medical</a></li>
                    </ul>
                </div>

                <div class="">
                    <h6>Quick Links</h6>
                    <ul class="footer-links">
                        <li><a href="./pages/main_site/about.php">About</a></li>
                        <li><a href="./pages/main_site/immigrant_services.php">Immigrant Services</a></li>
                        <li><a href="./pages/main_site/visitor_service.php">Visitor Services</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="./pages/main_site/contact.php">Contact</a></li>
                        <li><a href="./pages/login/login.php">Login</a></li>
                    </ul>
                </div>
            </div>
            <hr>
        </div>
        <div class="container">
            <div class="grid grid-3">
                <div class="">
                    <p class="copyright-text">Wanderlust &copy; 2021. All Rights Reserved.
                    </p>
                </div>

                <div style="margin-top: 10px;">
                    <ul class="social-icons">
                        <li><a class="facebook" href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a class="instagram" href="#"><i class="fab fa-instagram"></i></a></li>
                        <li><a class="youtube" href="#"><i class="fab fa-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- ! If user in session -->
    <div id="location-select-modal-container" class="modal-container">
        <div class="modal" id="location-select-modal">
            <div class="modal-header flex-left space-between" style="align-items: center;">
                <p style="margin-left: 12px;">Select Location</p>
                <a href="#" class="cancel" style="float: right;">x</a>
            </div>
            <div class="modal-content" style="align-items:center;">
                <form class="flex-center" style="gap: 12px;">
                    <div class="form-control"> <select id="location-select" name="location" id="location">
                            <option value="choose" disabled selected>Change your location</option>
                            <option value="arlington">Arlington</option>
                            <option value="newyork">New York</option>
                            <option value="hongkong">Hong Kong</option>
                            <option value="bangalore">Bangalore</option>
                            <option value="london">London</option>
                            <option value="dubai">Dubai</option>
                        </select></div>
                    <div>
                        <button class="cancel btn btn-outline-secondary text-secondary">Cancel</button>
                        <button class="btn" type="submit">Change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0_dAAs1OTudl40Hb_CZZYqqSl-01V2fs&callback=initMap">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Faker/3.1.0/faker.min.js"
        integrity="sha512-/seDHxVfh1NvFUscAj8GsHQVZJvr2jjAoYsNL7As2FCaFHUHYIarl3sRCvVlFgyouVNiRgHIebyLKjpgd1SLDw=="
        crossorigin="anonymous"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="../../static/js/app.js"></script>
</body>

</html>