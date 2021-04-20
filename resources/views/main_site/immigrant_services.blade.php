<?php session_start(); ?>
<!-- 
Author: Manjunatha, Angad Tarikere
ID: 1001718335
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
    <link rel="icon" href="{{ URL::asset('favicon.ico') }}" />
    <title>Wanderlust | Immigrant Services</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />
        <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/angad.css') }}">
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
                    <li><a href="{{url('/about')}}">About</a></li>
                    <li class="dropdown">
                        <a href="#" active>Services <i class="fas fa-angle-down" style="margin-left: 5px;"></i></a>
                        <ul class="dropdown-content">
                            <li><a class="dropdown-item" href="{{url('/immigrant-services')}}">Immigrant Services</a></li>
                            <li><a class="dropdown-item" href="{{url('/visitor-services')}}">Visitor Services</a></li>
                        </ul>
                    </li>
                    <li><a href="/blog">Blog</a></li>
                    <li><a href="{{url('/contact')}}">Contact</a></li>
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

    <section style="background-color: var(--primary-color); padding:20px 0;">
        <div class="container">
            <div class="flex-left" style="justify-content: space-between; align-items:center;">
                <div class="col-lg-6">
                    <h2 class="display-4">Immigrant Services</h2>
                </div>
                <img src="../../static/img/passport.png" alt="hero-img" style="padding: 50px 0px; width:300px;" />
            </div>
        </div>
    </section>

    <br>

    <section class="container">
        <ul class="c-services">
            <div class="card bb-green">
                <li class="c-services__item">
                    <h3><i class="fas fa-list fa-1x mb-2 text-success"></i>&nbsp Search categories</h3>
                    <p>We provide you with the latest and established categories of businesses in the selected locality,
                        personalized for you, to match your requirements.</p>
                </li>
            </div>
            <div class="card bb-green">
                <li class="c-services__item">
                    <h3><i class="fas fa-blog fa-1x mb-3 text-success"></i>&nbsp Blogs</h3>
                    <p>It’s time for you to write your best blog. We provide you with the access/feature to write about
                        your opinions and feelings about the businesses or attractions you recently visited or already
                        familiar
                        with.
                        Help the visitors familiarize with the city or the local area by helping them gain more
                        information
                        from
                        your blog</p>
                </li>
            </div>
            <div class="card bb-green">
                <li class="c-services__item">
                    <h3><i class="fas fa-book-open a-1x mb-3 text-success"></i>&nbsp Review and Tips</h3>
                    <p>Give and, Receive too. Leave Reviews and Tips on Wanderlust. Help users across the globe get
                        familiar
                        with the place they are located in.
                        Providing reviews and giving tips about a certain location or the businesses attached to it will
                        be
                        a
                        great benefit to all the users who are on the ,
                        look out for more quality information about their favorite spots!</p>
                </li>
            </div>
            <div class="card bb-green">
                <li class="c-services__item">
                    <h3><i class="fas fa-comments fa-1x mb-3 text-success"></i>&nbsp Chat</h3>
                    <p>A personalized chat room for the users! Users can come together to discuss and provide
                        information to
                        those seeking .
                        Provides an interface where users can chat one- to- one or many -to- many. Helps in bringing our
                        Wanderlust community together .</p>
                </li>
            </div>
            <div class="card bb-green">
                <li class="c-services__item">
                    <h3><i class="fas fa-photo-video fa-1x mb-3 text-success"></i>&nbsp Upload pictures & videos</h3>
                    <p>Make your space all the more colorful. Wanderlust provides you with the access to upload photos
                        and
                        videos of the city,
                        local area or the businesses involved that will be of great assist to all the wanderers
                        navigating
                        through our site.</p>
                </li>
            </div>
            <div class="card bb-green">
                <li class="c-services__item">
                    <h3><i class="fas fa-map-marker-alt fa-1x mb-3 text-success"></i>&nbsp Local businesses &
                        attractions
                    </h3>
                    <p>Find businesses and attractions around you. Check out their ratings and reviews and see their location and oprationg hours. Phone numbers are listed too.</p>
                </li>
            </div>
        </ul>
    </section>

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
                        <li><a href="{{url('/about')}}">About</a></li>
                        <li><a href="{{url('/immigrant-services')}}">Immigrant Services</a></li>
                        <li><a href="{{url('/visitor-services')}}">Visitor Services</a></li>
                        <li><a href="/blog">Blog</a></li>
                        <li><a href="{{url('/contact')}}">Contact</a></li>
                        <li><a href="{{url('/login')}}">Login</a></li>
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
    <script src="{{ URL::asset('js/app.js') }}"></script>
</body>

</html>