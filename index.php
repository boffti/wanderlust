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
    <link rel="icon" href="./static/favicon.ico" />
    <title>Wanderlust | Home</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />
    <link href="./static/css/style.css" rel="stylesheet">
</head>

<body>
    <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <!-- Navbar -->
    <div id="navbar" class="navbar navbar-primary flex-wrap">
        <div class="container flex mobile-nav">
            <h1>Wanderlust</h1>
            <nav>
                <ul class="hidden">
                    <li><a href="#" active>Home</a></li>
                    <li><a href="./pages/main_site/about.php">About</a></li>
                    <li class="dropdown">
                        <a href="#" class="">Services <i class="fas fa-angle-down" style="margin-left: 5px;"></i>
                        </a>
                        <ul class="dropdown-content">
                            <li><a class="dropdown-item" href="./pages/main_site/immigrant_services.php">Immigrant
                                    Services</a></li>
                            <li><a class="dropdown-item" href="./pages/main_site/visitor_service.php">Visitor
                                    Services</a></li>
                        </ul>
                    </li>
                    <li><a href="/blog">Blog</a></li>
                    <li><a href="./pages/main_site/contact.php">Contact</a></li>
                </ul>
            </nav>

            <!-- ! If user not in session -->
            <!-- <div class="signup">
                <button class="btn btn-outline-secondary">Login / Signup</button>
            </div> -->

            <?php 

            if(in_array('3', $_SESSION['user_roles'])) {
                $admin_markup = <<<am
                <!-- ! If Role == Admin -->
                <li class="dropdown-item">
                    <a href="./pages/admin/country_admin.php">
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
                    <a href="./pages/admin/super_admin.php">
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
                                <a href="./pages/user/profile.php">
                                    <i class="fas fa-user" style="margin-right: 8px;"></i>
                                    My Profile
                                </a>
                            </li>
                            {$admin_markup}
                            {$super_admin_markup}
                            <li class="dropdown-item">
                                <a href="./php/logout.php">
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
                            <a href="./pages/login/login.php">
                                <button class="btn btn-outline-accent text-accent">Login / Signup</button>
                            </a>
                        </div>';
            }
            ?>
            <a id="btnMenu" href="#" class="menu-icon"><i class="fas fa-bars"></i></a>
        </div>
    </div>

    <!-- hero -->
    <section class="hero flex">
        <div class="container">
            <div class="hero-text flex-vertical">
                <div id="typed">
                    <p>Welcome to your new home</p>
                    <p>Willkommen in Ihrem neuen Zuhause</p>
                    <p>Bienvenido a tu nuevo hogar</p>
                    <p>आपके नए घर में आपका स्वागत है</p>
                    <p>欢迎来到你的新家</p>
                    <p>Bienvenue dans votre nouvelle maison</p>
                    <p>새 집에 오신 것을 환영합니다</p>
                    <p>നിങ്ങളുടെ പുതിയ വീട്ടിലേക്ക് സ്വാഗതം</p>
                    <p>ನಿಮ್ಮ ಹೊಸ ಮನೆಗೆ ಸುಸ್ವಾಗತ</p>
                    <p>உங்கள் புதிய வீட்டிற்கு வருக</p>
                    <p>Laipni lūdzam jūsu jaunajās mājās</p>
                </div>
                <h1 id="welcome-string"></h1><span style="visibility:hidden;">|</span>
            </div>
            <p class="flex-vertical">Find nearby attractions. Connect with people. Contribute to your neighborhood.</p>
            <div class="">
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
            </div>
        </div>
    </section>

    

    <div class="container">
        <div class="content">

            <!-- Explore Nearby -->
            <section>
                <h2>Explore nearby</h2>
                <div>
                    <div class="flex" style="gap:12px">
                    <?php 
                        include './php/functions.php';
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
                                        <h1><a href="./pages/business/business_detail.php?business_id={$item['business_id']}">{$item['business_name']}</a></h1>
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
                </div>
                <div class="" style="margin-top: 10px;">
                    <a href="./pages/user/search_page.php">See more</a>
                </div>
            </section>

            <br>

            <!-- Bulletin Board -->
            <section>
                <h2>Bulletin Board</h2>
                <!-- ! IF User.role != visitor -->
                <form action="./php/posts_handler.php" method="post">
                    <div class="flex-left">
                        <textarea placeholder="What's on your mind? Type here..." name="post_content" id="bulletin_post"
                            cols="30" rows="3" style="width: 100%; padding:12px; margin: 12px" class="card"></textarea>
                        <div class="card">
                            <p>See the latest buzz around you. Create your own buzz.</p>
                        </div>
                        <input name="loc" value="1" style="display:none;">
                    </div>
                    <button type="submit" class="btn" style="margin:0 12px;">POST</button>
                </form>
                <!-- ! ENDIF -->
                <div class="posts">
                <?php
                    $sql_city_posts = "SELECT posts.post_id, posts.post_content, posts.created_at, users.user_id, users.full_name, cities.city_id, cities.city_name from posts, cities, users where posts.user_id=users.user_id and posts.city_id=cities.city_id and cities.city_name='{$_SESSION['user_loc']['city_name']}' limit 5";
                    $city_posts = $conn->query($sql_city_posts);
                    if($city_posts->num_rows > 0) {                          
                        while($item = $city_posts->fetch_assoc()) {
                            echo <<<posts
                            <div class="card post">
                                <div class="flex-left">
                                    <img class="postIMG" src="" alt="">
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
                <a href="./pages/user/posts.php" style="margin-left: 12px;">See all</a>
            </section>

            <br>
            <!-- Tips -->
            <section>
                <h2>Word to the Wise</h2>
                <div class="tips">
                <?php
                    $sql_city_tips = "SELECT tips.tip_id, tips.tip_content, users.user_id, users.full_name, cities.city_id, cities.city_name from tips, cities, users where tips.user_id=users.user_id and tips.city_id=cities.city_id and cities.city_name='{$_SESSION['user_loc']['city_name']}' limit 3";
                    $city_tips = $conn->query($sql_city_tips);
                    if($city_tips->num_rows > 0) {                          
                        while($item = $city_tips->fetch_assoc()) {
                            echo <<<explore
                            <div class="card border-l-yellow">
                                <div class="flex flex-column align-items-left">
                                    <div>
                                        <span class="quotes">"</span><strong>
                                            {$item['tip_content']}
                                        </strong><span class="quotes">"</span>
                                    </div>
                                    <div class="flex ml-auto tip-footer" style="gap: 10px; ">
                                        <a class="tip-author" href="#" style="margin: 0;">{$item['full_name']}</a>
                                    </div>
                                </div>
                            </div>
                            explore;
                        }
                    }
                ?>
                </div>
                <div class="flex" style="justify-content: space-between; padding: 0 15px">
                    <a href="./pages/user/tips.php?city_id=<?php echo $_SESSION['user_loc']['city_id'];?>" class="">See more tips</a>
                    <a href="./pages/user/tips.php?city_id=<?php echo $_SESSION['user_loc']['city_id'];?>" class="strong">+ ADD TIP</a>
                </div>
            </section>

            <br>

            <!-- Categories -->
            <section class="">
                <h2>Browse by Category</h2>
                <div class="flex" style="gap: 12px;">
                    <div class="category-card">
                        <a href="./pages/user/search_page.php" class="card-link"></a>
                        <i class="fas fa-hamburger fa-5x"></i>
                        <div class="content">
                            <h2>Restaurant</h2>
                        </div>
                    </div>
                    <div class="category-card">
                        <a href="./pages/user/search_page.php" class="card-link"></a>
                        <i class="fas fa-shopping-cart fa-5x"></i>
                        <div class="content">
                            <h2>Shopping</h2>
                        </div>
                    </div>
                    <div class="category-card">
                        <a href="./pages/user/search_page.php" class="card-link"></a>
                        <i class="fas fa-book-open fa-5x"></i>
                        <div class="content">
                            <h2>Education</h2>
                        </div>
                    </div>
                </div>
                <div class="flex" style="gap: 12px; margin-top:12px">
                    <div class="category-card">
                        <a href="./pages/user/search_page.php" class="card-link"></a>
                        <i class="fas fa-praying-hands fa-5x"></i>
                        <div class="content">
                            <h2>Religion & Worship</h2>
                        </div>
                    </div>
                    <div class="category-card">
                        <a href="./pages/user/search_page.php" class="card-link"></a>
                        <i class="fas fa-ticket-alt fa-5x"></i>
                        <div class="content">
                            <h2>Entertainment</h2>
                        </div>
                    </div>
                    <div class="category-card">
                        <a href="./pages/user/search_page.php" class="card-link"></a>
                        <i class="fas fa-syringe fa-5x"></i>
                        <div class="content">
                            <h2>Health & Medical</h2>
                        </div>
                    </div>
                </div>
                <br>
            </section>
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
                        <li><a href="/blog">Blog</a></li>
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
                <form action="./php/change_loc_handler.php" class="flex-center" style="gap: 12px;">
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Faker/3.1.0/faker.min.js"
        integrity="sha512-/seDHxVfh1NvFUscAj8GsHQVZJvr2jjAoYsNL7As2FCaFHUHYIarl3sRCvVlFgyouVNiRgHIebyLKjpgd1SLDw=="
        crossorigin="anonymous"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="./static/js/typed.js"></script>
    <script>
        var typed = new Typed('#welcome-string', {
            stringsElement: '#typed',
            showCursor: false,
            cursorChar: '|',
            typeSpeed: 70,
            backSpeed: 70,
            backDelay: 5000,
            loop: true,
            loopCount: Infinity,
        });
    </script>
    <script src="./static/js/app.js"></script>
</body>

</html>