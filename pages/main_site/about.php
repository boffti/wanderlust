<?php session_start(); ?>
<!-- 
Author: Manjunatha, Angad Tarikere
ID: 1001718335
 -->
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!<![endif]-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="../../static/favicon.ico" />
    <title>Wanderlust | About</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="../../static/css/style.css">
    <link rel="stylesheet" href="../../static/css/angad.css">
</head>

<body>
    <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <!-- Navbar -->
    <div id="navbar" class="navbar navbar-primary">
        <div class="container flex">
            <h1>Wanderlust</h1>
            <nav>
                <ul class="hidden">
                    <li><a href="../../">Home</a></li>
                    <li><a href="./about.php" active>About</a></li>
                    <li class="dropdown">
                        <a href="#" class="">Services <i class="fas fa-angle-down" style="margin-left: 5px;"></i>
                        </a>
                        <ul class="dropdown-content">
                            <li><a class="dropdown-item" href="./immigrant_services.php">Immigrant Services</a></li>
                            <li><a class="dropdown-item" href="./visitor_service.php">Visitor Services</a></li>
                        </ul>
                    </li>
                    <li><a href="/blog">Blog</a></li>
                    <li><a href="./contact.php">Contact</a></li>
                </ul>
            </nav>

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
            <a id="btnMenu" href="#" class="menu-icon"><i class="fas fa-bars"></i></a>
        </div>
    </div>

    <section style="background-color: var(--primary-color); padding:60px 0;">
        <div class="container">
            <div class="flex-left" style="justify-content: space-between; align-items:center;">
                <div class="flex-column">
                    <h2 class="display-4">Welcome to Wanderlust</h2>
                    <h4 class="lead text-muted">Your space, your voice, your home.</h4>
                </div>
                <img src="../../static/img/route.png" alt="hero-img" style="padding: 50px 0px; width:400px;" />
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
                    <a href="../../index.php"> <button class="btn btn-success text-white">Start Now</button>
                    </a>
                </div>
                <div class="col-lg-5 px-5 mx-auto order-1 order-lg-2"><img src="../../static/img/world.png" alt=""
                        class="img-fluid mb-4 mb-lg-0">
                </div>
            </div>
            <div class="row align-items-center mb-5">
                <div class="col-lg-5 px-5 mx-auto"><img src="../../static/img/passport.png" alt=""
                        class="img-fluid mb-4 mb-lg-0"></div>
                <div class="col-lg-6"> <i class="fas fa-comments fa-2x mb-3 text-success"></i>
                    <h4 class="font-weight-light">Meet new people</h4>
                    <p class="font-italic text-muted mb-4">Wanderlust is your passport to find some really cool place
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
                <div class="col-lg-5 px-5 mx-auto order-1 order-lg-2"><img src="../../static/img/profile.png" alt=""
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
                        <img src="../../static/img/aneesh.jpg" alt="aneesh" style="width: 200px; border-radius:100px;">
                        <p style="font-size:1.3rem;">Aneesh Melkot</p>
                    </div>
                    <div class="card flex-center">
                        <img src="../../static/img/angad.jpeg" alt="aneesh" style="width: 200px; border-radius:100px;">
                        <p style="font-size:1.3rem;">Angad Manjunath</p>
                    </div>
                    <div class="card flex-center">
                        <img src="../../static/img/karthik.jpeg" alt="aneesh"
                            style="width: 200px; border-radius:100px;">
                        <p style="font-size:1.3rem;">Karthik Natarajan</p>
                    </div>
                    <div class="card flex-center">
                        <img src="../../static/img/gabriel.jpeg" alt="aneesh"
                            style="width: 200px; border-radius:100px;">
                        <p style="font-size:1.3rem;">Gabriel Sundalkar</p>
                    </div>
                </div>
            </div>
        </section>
        <br>

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
                        <li><a href="./about.php">About</a></li>
                        <li><a href="./immigrant_services.php">Immigrant Services</a></li>
                        <li><a href="./visitor_service.php">Visitor Services</a></li>
                        <li><a href="/blog">Blog</a></li>
                        <li><a href="./contact.php">Contact</a></li>
                        <li><a href="../login/login.php">Login</a></li>
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