<?php session_start();
include '../../php/functions.php';
?>
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


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="../../static/favicon.ico" />
    <title>WL | Posts</title>
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
    <div id="navbar" class="navbar navbar-primary">
        <div class="container flex">
            <h1>Wanderlust</h1>
            <nav>
                <ul class="hidden">
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
                            
                $dp = $_SESSION['user']['dp'];

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
    <section style="background-color: var(--primary-color); padding:50px 0;">
        <div class="container">
            <div class="flex-center" style="justify-content: space-between; align-items:center;">
                <form class="hero-form card" action="./pages/user/search_page.php" style="overflow: hidden;">
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
                            </select></div>
                        <button id="btnSearchNow" type="submit" href="#" class="btn">SEARCH
                            NOW</button>
                    </div>
                </form>
                <br>
                <h2 class="display-4">Check out the latest buzz in your city</h2>
            </div>
        </div>
    </section>

    <div class="container">

        <form action="../../php/posts_handler.php" method="post">
            <div class="flex-left">
                <textarea placeholder="Whats on your mind? Type here..." name="post_content" id="bulletin_post" cols="30" rows="3"
                    style="width: 100%; padding:12px; margin: 12px" class="card"></textarea>
                <div class="card">
                    <p>See the latest buzz around you. Create your own buzz.</p>
                </div>
                <input name="loc" value="2" style="display:none;">
            </div>
            <button type="submit" class="btn" style="margin:0 12px;">POST</button>
        </form>
        <br>
        <div class="posts">
            <?php
                $conn = get_db_conn();
                $sql_city_posts = "SELECT posts.post_id, posts.post_content, posts.created_at, users.user_id, users.full_name, users.dp, cities.city_id, cities.city_name from posts, cities, users where posts.user_id=users.user_id and posts.city_id=cities.city_id and cities.city_name='{$_SESSION['user_loc']['city_name']}' limit 5";
                $city_posts = $conn->query($sql_city_posts);
                if($city_posts->num_rows > 0) {                          
                    while($item = $city_posts->fetch_assoc()) {
                        echo <<<posts
                        <div class="card post">
                            <div class="flex-left">
                                <img class="" src="../../static/upload/user_dp/{$item['dp']}" alt="">
                                <div class="full-width">
                                    <div class="flex-left space-between align-items-center">
                                        <a href="#">
                                            <h4 class="">{$item['full_name']}</h4>
                                        </a>
                                        <p class="post-date">{$item['created_at']}</p>
                                    </div>
                                    <p class="">{$item['post_content']}</p>
                                </div>
                            </div>
                        </div>
                        posts;
                    }
                }
            ?>
        </div>
    </div>


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
                <form action="../../php/change_loc_handler.php" class="flex-center" style="gap: 12px;" method='POST'>
                    <div class="form-control"> <select id="location-select" name="location" id="location">
                    <option value="choose" disabled selected>Change your location</option>
                            <?php
                                if(isset($_SESSION['user'])){
                                    $sql_city_options= "SELECT city_id, city_name from cities";
                                    $cities = $conn->query($sql_city_options);
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
                    <div>
                        <button class="btn" type="submit">Change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Faker/3.1.0/faker.min.js"
        integrity="sha512-/seDHxVfh1NvFUscAj8GsHQVZJvr2jjAoYsNL7As2FCaFHUHYIarl3sRCvVlFgyouVNiRgHIebyLKjpgd1SLDw=="
        crossorigin="anonymous"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="../../static/js/app.js"></script>
</body>

</html>