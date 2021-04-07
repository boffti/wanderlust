<?php
session_start();
include '../../php/functions.php';
$conn = get_db_conn();
$sql_get_business = "SELECT business.business_id, business.business_name, business.business_website, business.business_desc, business.business_phone, business.business_address, business.photo_uri, cities.city_id, cities.city_name, categories.category_name from business, cities, categories where business.city_id=cities.city_id and categories.category_id=business.category and business.business_id='{$_GET['business_id']}'";
$business_result = $conn->query($sql_get_business);
$business = $business_result->fetch_assoc();
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
    <title>WL | <?php echo $business['business_name'];?></title>
    <link rel="icon" href="../../static/favicon.ico" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="../../static/css/style.css">
</head>

<body>
    <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <!-- Navbar -->
    <div id="navbar" class="navbar" style="height: 100%;">
        <div class="container flex">
            <a href="../../index.php">
                <h1>Wanderlust</h1>
            </a>

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

            <!-- <div class="signup">
                <button class="btn btn-outline-secondary">Login / Signup</button>
            </div> -->
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
        </div>
    </div>

    <div class="container">

        <!-- Search Bar -->
        <section class="flex">
            <form class="hero-form card flex" action="#">
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
                <button id="btnSearchNow" type="submit" href="#" class="btn" style="margin-left: 25px;">SEARCH
                    NOW</button>
            </form>
        </section>
        <br>
        <!-- Business Header -->

        <section>
            <div class="flex-left" style="justify-content: space-between;">
                <div>
                    <h1 class="strong" style="font-size: 45px; margin-bottom:0;">
                        <?php echo $business['business_name']; ?>
                    </h1>
                    <div class="rating flex-left" style="font-size: 40px; align-items:center;">
                        <ul style="padding-left:0;">
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="far fa-star"></i></li>
                        </ul>
                        <span class="rating-count">24 reviews</span>
                    </div>
                    <p class="business-category"></p>
                    <div class="business-timings">
                        <span style="color: var(--other-color-1); font-weight:bold; margin-right:10px;">Open</span> Open
                        24
                        hours
                    </div>
                    <br>
                    <div>
                        <button id="btnWriteReview" class="btn" style="font-size: large;"><i class="far fa-star"
                                style="margin-right: 10px;"></i> Write a Review</button>
                        <button id="btnUploadBusinessPhoto" class="btn btn-outline-secondary text-secondary"
                            style="font-size: large;"><i class="fas fa-camera" style="margin-right: 10px;"></i> Add
                            Photo</button>
                        <input id="fileBusinessPhoto" type="file" name="" id="" style="display: none;">
                        <button class="btn btn-outline-secondary text-secondary" style="font-size: large;"><i
                                class="fas fa-share-alt" style="margin-right: 10px;"></i> Share</button>
                    </div>
                </div>

                <div style="margin-top:1.2em;">
                    <span><i class="fas fa-external-link-alt" style="margin-right:8px;"></i><a href="#"
                            class="text-accent" style="margin-bottom:12px;"><?php echo $business['business_website']; ?></a></span>
                    <p><i class="fas fa-phone-alt" style="margin-right:8px;"></i> <?php echo $business['business_phone']; ?></p>
                </div>
            </div>
        </section>
        <br>
        <hr>
        <br>


        <section>
            <div>
                <h2>COVID-19 Safety Measures</h2>
                <div class="flex-left" style="justify-content: space-between;">
                    <span class="strong"><i class="fas fa-check wander-green" style="margin-right:8px"></i>Staff wears
                        masks</span>
                    <span class="strong"><i class="fas fa-check wander-green" style="margin-right:8px"></i>Sanitized
                        frequently</span>
                    <span class="strong"><i class="fas fa-check wander-green" style="margin-right:8px"></i>Staff wears
                        gloves</span>
                    <span class="strong"><i class="fas fa-check wander-green" style="margin-right:8px"></i>Staff
                        temperature checks</span>
                    <span class="strong"><i class="fas fa-check wander-green" style="margin-right:8px"></i>Contactless
                        payments</span>
                </div>
            </div>
        </section>

        <br>
        <hr>
        <br>

        <!-- Business Description Section -->
        <section>
            <div>
                <h2>About the Business</h2>
                <div class="card">
                    <p><?php echo $business['business_desc']; ?></p>
                </div>
            </div>
        </section>

        <br>
        <hr>
        <br>

        <!-- Photo Gallery Section -->
        <section>
            <div>
                <div class="flex-left" style="justify-content: space-between;">
                    <h2>Photos</h2>
                    <a href="#">See more</a>
                </div>
                <div class="flex-left">
                    <!-- Define all of the tiles: -->
                    <div class="box">
                        <div class="img-box">
                            <img
                                src="https://images.unsplash.com/photo-1614038276039-667c23bc32fa?ixid=MXwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw3fHx8ZW58MHx8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" />
                        </div>
                    </div>
                    <div class="box">
                        <div class="img-box">
                            <img
                                src="https://images.unsplash.com/photo-1614059632169-522876ce04c8?ixid=MXwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHw4fHx8ZW58MHx8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" />
                        </div>
                    </div>
                    <div class="box">
                        <div class="img-box">
                            <img
                                src="https://images.unsplash.com/photo-1613977257421-010b50211cd3?ixid=MXwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwxOXx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" />
                        </div>
                    </div>
                    <div class="box">
                        <div class="img-box">
                            <img
                                src="https://images.unsplash.com/photo-1614036102254-b5a105bc3537?ixid=MXwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwyNnx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" />
                        </div>
                    </div>
                    <div class="box">
                        <div class="img-box">
                            <img
                                src="https://images.unsplash.com/photo-1614022995184-0347cdc53871?ixid=MXwxMjA3fDB8MHxlZGl0b3JpYWwtZmVlZHwyN3x8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <br>
        <hr>
        <br>

        <!-- Tips Section -->
        <section>
            <div class="flex-left" style="justify-content: space-between;">
                <h2>Word to the Wise</h2>
                <a href="./business_tips.php">See more</a>
            </div>
            <div class="tips">
                <div class="card border-l-yellow">
                    <div class="flex flex-column align-items-left">
                        <div>
                            <span class="quotes">"</span><strong>
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Adipisci quibusdam
                                accusantium, fugiat debitis dolorem iure soluta cum consequuntur dignissimos animi
                                tenetur magnam sit, perferendis illo, quidem quis. Facere, nostrum sit.
                            </strong><span class="quotes">"</span>
                        </div>
                        <div class="flex ml-auto" style="gap: 10px; ">
                            <a class="tip-author" href="#" style="margin: 0;">Jagan Das</a>
                        </div>
                    </div>
                </div>

                <div class="card border-l-yellow">
                    <div class="flex flex-column align-items-left">
                        <div>
                            <span class="quotes">"</span><strong>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Facilis harum eius optio. Delectus repellat sunt eveniet neque nesciunt assumenda
                                debitis, ullam impedit molestiae tempore deleniti corporis officiis ipsa expedita
                                repudiandae.
                            </strong><span class="quotes">"</span>
                        </div>
                        <div class="flex ml-auto" style="gap: 10px; ">
                            <a class="tip-author" href="#" style="margin: 0;">Mark Appleseed</a>
                        </div>
                    </div>
                </div>

                <div class="card border-l-yellow">
                    <div class="flex flex-column align-items-left">
                        <div>
                            <span class="quotes">"</span><strong>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis at blanditiis
                                quasi minima eveniet maiores enim praesentium qui dolorum, est perferendis, delectus
                                tenetur deserunt ipsam, cumque officia itaque. Temporibus, laborum.
                            </strong><span class="quotes">"</span>
                        </div>
                        <div class="flex ml-auto" style="gap: 10px; ">
                            <a class="tip-author" href="#" style="margin: 0;">Aima Ho</a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="flex" style="justify-content: space-between; padding: 0 15px">
                <a href="./business_tips.php" class="strong">Write Tip +</a>
            </div>
        </section>

        <br>
        <hr>
        <br>

        <!-- Location & Hours section -->
        <section>
            <div>
                <h2>Location & Hours</h2>
                <div class="flex-left" style="gap:20px;">
                    <div>
                        <div class="" style="height: 80%; width:500px; margin-right:20px;"><iframe frameborder="0"
                                style="border:0; width:100%; height:100%;"
                                src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0Dx_boXQiwvdz8sJHoYeZNVTdoWONYkU&amp;q=place_id:EntLYW5ha2FwdXJhIFJkLCBKUCBOYWdhciA2dGggUGhhc2UsIEtyaXNobmEgRGV2YXJheWEgTmFnYXIsIFllbGFjaGVuYWhhbGxsaSwgS3VtYXJhc3dhbXkgTGF5b3V0LCBCZW5nYWx1cnUsIEthcm5hdGFrYSwgSW5kaWEiLiosChQKEglTQD7jdxWuOxHVyhgiZUBnDxIUChIJuczhjGcVrjsR8l2WW9YHnZw&key=AIzaSyA0Dx_boXQiwvdz8sJHoYeZNVTdoWONYkU"
                                allowfullscreen=""></iframe></div>
                        <p class="strong" style="margin-bottom: 0;"><?php echo $business['business_address']; ?></p>
                        <p style="margin-top: 0;"><?php echo $business['city_name']; ?></p>
                    </div>
                    <div>
                        <table>
                            <tr style="padding: 6px;">
                                <td class="strong">
                                    Monday
                                </td>
                                <td>
                                    Open 24 hours
                                </td>
                            </tr>
                            <tr style="padding: 6px;">
                                <td class="strong">
                                    Tuesday
                                </td>
                                <td>
                                    Open 24 hours
                                </td>
                            </tr>
                            <tr style="padding: 6px;">
                                <td class="strong">
                                    Wednesday
                                </td>
                                <td>
                                    Open 24 hours
                                </td>
                            </tr>
                            <tr style="padding: 6px;">
                                <td class="strong">
                                    Thursday
                                </td>
                                <td>
                                    Open 24 hours
                                </td>
                            </tr>
                            <tr style="padding: 6px;">
                                <td class="strong">
                                    Friday
                                </td>
                                <td>
                                    Open 24 hours
                                </td>
                            </tr>
                            <tr style="padding: 6px;">
                                <td class="strong">
                                    Saturday
                                </td>
                                <td>
                                    4:00 PM - 11:00 PM
                                </td>
                            </tr>
                            <tr style="padding: 6px;">
                                <td class="strong">
                                    Sunday
                                </td>
                                <td>
                                    4:00 PM - 11:00 PM
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </section>

        <br>
        <hr>
        <br>

        <!-- Question & Answers section -->
        <!-- <section>
            <div>
                <div class="flex-left" style="justify-content: space-between;">
                    <h2>Ask the Community</h2>
                    <a href="#" class="strong" style="font-size: 18px;">Ask a question +</a>
                </div>
                <div>

                </div>
            </div>
        </section>

        <br>
        <hr>
        <br> -->

        <!-- Reviews Section -->
        <section id="review-section">
            <div>
                <div class="flex-left" style="justify-content: space-between;">
                    <h2>Reviews</h2>
                </div>
                <div class="card">
                    <h3>Leave a review</h3>
                    <div class="rating flex-left" style="font-size: 20px; justify-content:space-between;">
                        <ul>
                            <li><i class="fas fa-star review-form-star"></i></li>
                            <li><i class="fas fa-star review-form-star"></i></li>
                            <li><i class="fas fa-star review-form-star"></i></li>
                            <li><i class="fas fa-star review-form-star"></i></li>
                            <li><i class="fas fa-star review-form-star"></i></li>
                        </ul>
                    </div>
                    <textarea placeholder="Remember, be nice!" id="w3review" name="w3review" rows="6" cols="30"
                        style="width: 100%;"></textarea>
                    <button class="btn">SUBMIT</button>
                </div>
                <div class="card">
                    <div class="review-card-header flex-left">
                        <img id=""
                            src="https://in.bmscdn.com/iedb/artist/images/website/poster/large/danish-sait-35531-07-11-2016-01-48-14.jpg"
                            alt="profile" class="review-card-user-img">
                        <div>
                            <h3>Danish Sait</h3>
                            <p class="wander-green">Arlington, TX</p>
                        </div>
                    </div>
                    <div class="rating flex-left" style="font-size: 20px; align-items:center;">
                        <ul>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="far fa-star"></i></li>
                        </ul>
                        <p style="font-size: 14px;">02/12/2021</p>
                    </div>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corporis debitis molestias alias
                        libero
                        repellendus autem sunt! Quaerat possimus, repellendus eaque ab ducimus distinctio magni
                        inventore
                        rerum repudiandae error id eveniet. Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic
                        nulla debitis nobis quaerat minima vero id provident numquam, voluptatum voluptate ipsam
                        possimus
                        ducimus! Sit, necessitatibus accusamus labore nam voluptatem assumenda!
                    </p>
                </div>
                <div class="card">
                    <div class="review-card-header flex-left">
                        <img id=""
                            src="https://www.biography.com/.image/t_share/MTE5NDg0MDU0ODE5MzQxODM5/tina-fey-365284-1-402.jpg"
                            alt="profile" class="review-card-user-img">
                        <div>
                            <h3>Tina Fey</h3>
                            <p class="wander-green">Arlington, TX</p>
                        </div>
                    </div>
                    <div class="rating flex-left" style="font-size: 20px; align-items:center;">
                        <ul>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                        </ul>
                        <p style="font-size: 14px;">02/12/2021</p>
                    </div>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corporis debitis molestias alias
                        libero
                        repellendus autem sunt! Quaerat possimus, Lorem, ipsum dolor sit amet consectetur adipisicing
                        elit.
                        Consequuntur, doloremque fuga! Molestias soluta dolore quasi quia reprehenderit ab tempore,
                        eius,
                        architecto est officiis illo minima vel. Corrupti corporis itaque maxime.
                    </p>
                </div>
                <div class="card">
                    <div class="review-card-header flex-left">
                        <img id=""
                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQqj-OkFV55geNPyjWSwPmeSkeipmC4uOcZjg&usqp=CAU"
                            alt="profile" class="review-card-user-img">
                        <div>
                            <h3>Kenny Sebastian</h3>
                            <p class="wander-green">Arlington, TX</p>
                        </div>
                    </div>
                    <div class="rating flex-left" style="font-size: 20px; align-items:center;">
                        <ul>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="fas fa-star"></i></li>
                            <li><i class="far fa-star"></i></li>
                            <li><i class="far fa-star"></i></li>
                        </ul>
                        <p style="font-size: 14px;">02/12/2021</p>
                    </div>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corporis debitis molestias alias
                        libero
                        repellendus autem sunt! Quaerat possimus, repellendus eaque ab ducimus distinctio magni
                        inventore
                        rerum repudiandae error id eveniet. Lorem ipsum dolor sit amet.
                    </p>
                </div>
            </div>
            <a href="./business_reviews.php" class="flex-center">See All</a>
        </section>
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
                        <li><a href="../main_site/about.php">About</a></li>
                        <li><a href="../main_site/immigrant_services.php">Immigrant Services</a></li>
                        <li><a href="../main_site/visitor_service.php">Visitor Services</a></li>
                        <li><a href="/blog">Blog</a></li>
                        <li><a href="../main_site/contact.php">Contact</a></li>
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