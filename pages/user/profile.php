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
include '../../php/functions.php';
// If the user is not logged in redirect to the login page...
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="../../static/favicon.ico" />
    <title>Wanderlust | My Profile</title>
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
    <div id="navbar" class="navbar" style="overflow: visible; background-color: white;">
        <div class="container flex">
            <a href="../../index.php">
                <h1 style="margin: 0; padding:0;">Wanderlust</h1>
            </a>
            <nav>
                <ul class="hidden">
                    <li><a href="../../index.php">Home</a></li>
                    <li><a href="../main_site/about.php">About</a></li>
                    <li class="dropdown"><a href="#" class="">Services <i class="fas fa-angle-down"
                                style="margin-left: 5px;"></i></a>
                        <ul class="dropdown-content">
                            <li><a class="dropdown-item" href="../main_site/immigrant_services.php">Immigrant
                                    Services</a></li>
                            <li><a class="dropdown-item" href="../main_site/visitor_service.php">Visitor Services</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="../main_site/contact.php">Contact</a></li>
                </ul>
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
    <section class="flex">
        <div class="container">
            <div class="hero-text flex-vertical">
                <h1 id="" style="font-size: 35px;">This is YOU.</h1>
                <p class="">What have you been up to lately? Use this page to upload your latest photos and videos.</p>
            </div>
            <!-- <div class="card"> -->
            <div class="flex-left">
                <div class="flex-center">
                    <div class="card"
                        style="height: fit-content; width:100%; border-top: 4px var(--accent-color) solid;">
                        <div class="flex-center">
                            <div class="profile-img-container">
                                <img id="profileIMG" src="" alt="profile" class="profileIMG"
                                    style="width: 200px; border-radius: 100px;">
                                <div class="icon-change-image">
                                    <a id="changeDP" href="#">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </div>
                            </div>
                            <h2 id="" class=""><?php echo $_SESSION['user']['full_name']?></h2>
                            <!-- <div class="flex-left space-between">
                                <a href="../admin/country_admin.php"
                                    class="btn btn-outline-secondary text-secondary">Admin</a>
                                <a href="../login/login.php"
                                    class="btn btn-outline-secondary text-secondary">Logout</a>
                            </div> -->
                            <input type="file" name="dp" id="inputChangeDP" style="display: none;">
                        </div>
                    </div>
                    <div class="card" style="width: 100%;">
                        <div class="flex-left space-between">
                            <h3>Your Details</h3>
                            <a id="btnEditProfile" href="#"><i class="fas fa-edit"></i></a>
                        </div>
                        <br>
                        <div class="flex-column" style="align-items: flex-start;">
                            <span class="flex"><i class="fas fa-user" style="margin-right: 12px;"></i>
                                <p class="strong"><?php echo $_SESSION['user']['full_name']?></p>
                            </span>
                            <span class="flex"><i class="fas fa-map-marker-alt" style="margin-right: 12px;"></i>
                                <p class=" strong"><?php echo $_SESSION['user']['address']?></p>
                            </span>
                            <span class="flex"><i class="fas fa-birthday-cake" style="margin-right: 12px;"></i>
                                <p class="strong"><?php echo $_SESSION['user']['dob']?></p>
                            </span>
                            <span class="flex"><i class="fas fa-suitcase" style="margin-right: 12px;"></i>
                                <p class="strong"><?php echo $_SESSION['user']['profession']?></p>
                            </span>
                            <!-- <span class="flex"><i class="fas fa-globe-americas" style="margin-right: 12px;"></i>
                                <p class="strong"><?php echo $_SESSION['user']['nationality']?></p>
                            </span> -->
                            <span class="flex"><i class="fas fa-phone-alt" style="margin-right: 12px;"></i>
                                <p class="strong"><?php echo $_SESSION['user']['mobile']?></p>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <ul class="tabs">
                        <li class="active">PHOTOS</li>
                        <li>VIDEOS</li>
                        <li>REVIEWS</li>
                        <li>TIPS</li>
                    </ul>

                    <ul class="tab-content">
                        <!-- Photos Tab -->
                        <li class="active">
                            <div class="tab-content-container">
                                <div class="flex">
                                    <h2 class="">Your photos - <span>10</span></h2>
                                    <button id="btnUploadPhoto" class="btn">ADD</button>
                                    <input type="file" name="user_photo" id="uploadPhotoInput" style="display: none;" />
                                </div>
                                <div class="gallery-container">
                                    <!-- Define all of the tiles: -->
                                    <?php 
                                        $conn = get_db_conn();
                                        $sql_user_photos = "SELECT photo_id, photo_uri, user_id from user_photos where user_id='{$_SESSION['user']['user_id']}'";
                                        $user_photos = $conn->query($sql_user_photos);
                                        if($user_photos->num_rows > 0) {                          
                                            while($item = $user_photos->fetch_assoc()) {
                                                echo <<<photos
                                                <div class="box">
                                                    <div class="img-box">
                                                        <img
                                                            src="../../static/upload/user_photos/{$item['photo_uri']}" />
                                                    </div>
                                                </div>
                                                photos;
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </li>

                        <!-- Videos Tab -->
                        <li>
                            <div class="tab-content-container">
                                <div class="flex">
                                    <h2 class="">Your Videos - <span>4</span></h2>
                                    <button id="btnUploadVideo" class="btn">ADD</button>
                                    <input name="user_video" type="file" id="uploadVideoInput" style="display: none;" />
                                </div>

                                <div>
                                    <?php 
                                        $conn = get_db_conn();
                                        $sql_user_videos = "SELECT video_id, video_uri, user_id from user_videos where user_id='{$_SESSION['user']['user_id']}'";
                                        $user_videos = $conn->query($sql_user_videos);
                                        if($user_videos->num_rows > 0) {                          
                                            while($item = $user_videos->fetch_assoc()) {
                                                echo <<<photos
                                                <div class="video-container">
                                                    <div class="">
                                                        <video  width="500" height="315"
                                                            src="../../static/upload/user_videos/{$item['video_uri']}" frameborder="0"
                                                            allowfullscreen controls></video >
                                                    </div>
                                                </div>
                                                photos;
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </li>

                        <!-- Reviews Tab -->
                        <li>
                            <div class="tab-content-container">
                                <h2 class="">Your Reviews - 2</h2>
                                <div class="card bt-secondary">
                                    <div class="review-card-header flex-left">
                                        <div>
                                            <h2>Old School Pizza Tavern</h2>
                                            <p class="wander-green">Arlington, TX</p>
                                        </div>
                                        <div class="flex ml-auto tip-footer" style="gap: 10px; ">
                                            <a href="#" style="margin: 0;"><i class="fas fa-trash-alt"></i></a>
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
                                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corporis debitis
                                        molestias alias
                                        libero
                                        repellendus autem sunt! Quaerat possimus, repellendus eaque ab ducimus
                                        distinctio magni
                                        inventore
                                        rerum repudiandae error id eveniet. Lorem ipsum dolor sit amet consectetur
                                        adipisicing elit. Hic
                                        nulla debitis nobis quaerat minima vero id provident numquam, voluptatum
                                        voluptate ipsam
                                        possimus
                                        ducimus! Sit, necessitatibus accusamus labore nam voluptatem assumenda!
                                    </p>
                                </div>
                                <div class="card bt-secondary">
                                    <div class="review-card-header flex-left">
                                        <div>
                                            <h2>Walmart</h2>
                                            <p class="wander-green">Arlington, TX</p>
                                        </div>
                                        <div class="flex ml-auto tip-footer" style="gap: 10px; ">
                                            <a href="#" style="margin: 0;"><i class="fas fa-trash-alt"></i></a>
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
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum nam a aut
                                        placeat minima ad, aliquam ipsam, qui repellat facilis harum suscipit, esse
                                        consequatur velit expedita molestiae sit voluptatem blanditiis?
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="tab-content-container">
                                <h2 class="">Your Tips - 3</h2>
                                <?php
                                    $conn = get_db_conn();
                                    $sql_user_tips = "SELECT tips.tip_id, tips.tip_content from tips where tips.user_id='{$_SESSION['user']['user_id']}'";
                                    $user_tips = $conn->query($sql_user_tips);
                                    if($user_tips->num_rows > 0) {                          
                                        while($item = $user_tips->fetch_assoc()) {
                                            echo <<<explore
                                            <div class="card border-l-yellow">
                                                <div class="flex flex-column align-items-left">
                                                    <div>
                                                        <span class="quotes">"</span><strong>
                                                            {$item['tip_content']}
                                                        </strong><span class="quotes">"</span>
                                                    </div>
                                                    <div class="flex ml-auto tip-footer" style="gap: 10px; ">
                                                        <a href="../../php/delete_tip.php?tip_id={$item['tip_id']}" style="margin: 0;"><i class="fas fa-trash-alt"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            explore;
                                        }
                                    }
                                ?>
                                </div>

                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- </div> -->
        </div>
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
                        <li><a href="../main_site/about.php">About</a></li>
                        <li><a href="../main_site/immigrant_services.php">Immigrant Services</a></li>
                        <li><a href="../main_site/visitor_service.php">Visitor Services</a></li>
                        <li><a href="#">Blog</a></li>
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

    <div id="profile-edit-modal-container" class="modal-container">
        <div class="modal" id="profile-edit-modal">
            <div class="modal-header flex-left space-between" style="align-items: center;">
                <p style="margin-left: 12px;">Edit your deets</p>
                <a href="#" class="cancel" style="float: right;">x</a>
            </div>
            <div class="modal-content" style="align-items:center;">
                <form class="flex-center" style="gap: 12px;">
                    <div class="flex-left">
                        <input type="text" name="firstName" id="" placeholder="Name">
                        <input type="text" name="country" id="" placeholder="Country">
                    </div>
                    <div class="flex-left">
                        <input type="text" name="phone" id="" placeholder="Phone">
                        <input type="text" name="dop" id="" placeholder="Date of birth">
                    </div>
                    <div class="flex-left">
                        <input type="text" name="address" id="" placeholder="Street Address">
                        <input type="text" name="address" id="" placeholder="Profession">
                    </div>
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
    <script src="../../static/js/typed.js"></script>
    <script src="../../static/js/app.js"></script>
</body>

</html>