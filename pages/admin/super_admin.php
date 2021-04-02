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

<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
include '../../php/functions.php';
// If the user is not logged in redirect to the login page...
?>

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
                        <a href="./admin/super_admin.php">
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

    <div class="wrapper">
        <div class="flex-left space-between">
            <div class="card info-card">
                <h2><i class="fas fa-users" style="margin-right: 6px;"></i> 2508</h2>
                <p class="text-muted">Number of users</p>
            </div>
            <div class="card info-card">
                <h2><i class="fas fa-pencil-alt" style="margin-right: 6px;"></i> 232452</h2>
                <p class="text-muted">Number of posts</p>
            </div>
            <div class="card info-card">
                <h2><i class="fas fa-map-marker-alt" style="margin-right: 6px;"></i> 1164</h2>
                <p class="text-muted">Places of Interest</p>
            </div>
            <div class="card info-card">
                <h2><i class="fas fa-info" style="margin-right: 6px;"></i> 345</h2>
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
                                    <th>#</th>
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
                                            <td>{$item['city_id']}</td>
                                            <td>{$item['city_name']}</td>
                                            <td>
                                                <a href="#"><i class="fas fa-trash-alt"></i></a>
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
                                                <a href="#"><i class="fas fa-trash-alt"></i></a>
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
                                                <a href="#"><i class="fas fa-trash-alt"></i></a>
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
                    <caption>Manage Admin
                        <a id="btnAddAdmin" href="#" class="strong" style="float: right;"><i class="fas fa-plus-circle"></i> ADD</a>
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
                        <tr>
                            <td>1</td>
                            <td>Gabriel Sundalkar</td>
                            <td>98456893456</td>
                            <td>angadmanjunath@gmail.com</td>
                            <td>U.S.A</td>
                            <td>
                                <a href="#"><i class="fas fa-pen"></i></a>
                                <a href="#"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Karthik Natarajan</td>
                            <td>6789875678</td>
                            <td>arlington@gmail.com</td>
                            <td>INDIA</td>
                            <td>
                                <a href="#"><i class="fas fa-pen"></i></a>
                                <a href="#"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
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
                        <tr>
                            <td>1</td>
                            <td>Gabriel Sundalkar</td>
                            <td>98456893456</td>
                            <td>angadmanjunath@gmail.com</td>
                            <td>U.S.A</td>
                            <td>
                                <a href="#"><i class="fas fa-pen"></i></a>
                                <a href="#"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Karthik Natarajan</td>
                            <td>6789875678</td>
                            <td>arlington@gmail.com</td>
                            <td>INDIA</td>
                            <td>
                                <a href="#"><i class="fas fa-pen"></i></a>
                                <a href="#"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card">
                <table>
                    <caption>Manage Places of Interest
                        <a id="btnAddPlaceOfInterest" href="#" class="strong" style="float: right;"><i class="fas fa-plus-circle"></i> ADD</a>
                    </caption>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>City</th>
                            <th>Place Name</th>
                            <th>Place Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Arlington</td>
                            <td>Old School Pizza Tavern</td>
                            <td>
                                <p class="disp-cont">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tenetur
                                    voluptas, </p>
                                <p class="more-cont" style="display:none;">perspiciatis illo voluptatum corporis placeat
                                    repellat beatae minus officia rem repudiandae recusandae cupiditate explicabo fugiat
                                    aspernatur labore ut harum assumenda?</p>
                                <a href="" class="readmore">Read more</a>
                            </td>
                            <td>
                                <a href="#"><i class="fas fa-pen"></i></a>
                                <a href="#"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>New York</td>
                            <td>Angad Manjunath</td>
                            <td>
                                <p class="disp-cont">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tenetur
                                    voluptas, </p>
                                <p class="more-cont" style="display:none;">perspiciatis illo voluptatum corporis placeat
                                    repellat beatae minus officia rem repudiandae recusandae cupiditate explicabo fugiat
                                    aspernatur labore ut harum assumenda?</p>
                                <a href="" class="readmore">Read more</a>
                            </td>
                            <td>
                                <a href="#"><i class="fas fa-pen"></i></a>
                                <a href="#"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="card">
                <table>
                    <caption>Manage Posts</caption>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>City</th>
                            <th>User Name</th>
                            <th>Post Content</th>
                            <th>Timestamp</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Arlington</td>
                            <td>Aneesh Melkot</td>
                            <td>
                                <p class="disp-cont">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tenetur
                                </p>
                                <p class="more-cont" style="display:none;">voluptas,perspiciatis illo voluptatum
                                    corporis placeat repellat beatae minus officia rem repudiandae recusandae cupiditate
                                    explicabo fugiat aspernatur labore ut harum assumenda?</p>
                                <a href="" class="readmore">Read more</a>
                            </td>
                            <td>12:16 12/43/4342</td>
                            <td>
                                <a href="#"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>New York</td>
                            <td>Angad Manjunath</td>
                            <td>
                                <p class="disp-cont">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tenetur
                                </p>
                                <p class="more-cont" style="display:none;">voluptas,perspiciatis illo voluptatum
                                    corporis placeat repellat beatae minus officia rem repudiandae recusandae cupiditate
                                    explicabo fugiat aspernatur labore ut harum assumenda?</p>
                                <a href="" class="readmore">Read more</a>
                            </td>
                            <td>12:16 12/43/4342</td>
                            <td>
                                <a href="#"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="card">
                <table>
                    <caption>Manage Tips</caption>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>City</th>
                            <th>User Name</th>
                            <th>Post Content</th>
                            <th>Timestamp</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Arlington</td>
                            <td>Aneesh Melkot</td>
                            <td>
                                <p class="disp-cont">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tenetur
                                </p>
                                <p class="more-cont" style="display:none;">voluptas,perspiciatis illo voluptatum
                                    corporis placeat repellat beatae minus officia rem repudiandae recusandae cupiditate
                                    explicabo fugiat aspernatur labore ut harum assumenda?</p>
                                <a href="" class="readmore">Read more</a>
                            </td>
                            <td>12:16 12/43/4342</td>
                            <td>
                                <a href="#"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>New York</td>
                            <td>Angad Manjunath</td>
                            <td>
                                <p class="disp-cont">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tenetur
                                </p>
                                <p class="more-cont" style="display:none;">voluptas,perspiciatis illo voluptatum
                                    corporis placeat repellat beatae minus officia rem repudiandae recusandae cupiditate
                                    explicabo fugiat aspernatur labore ut harum assumenda?</p>
                                <a href="" class="readmore">Read more</a>
                            </td>
                            <td>12:16 12/43/4342</td>
                            <td>
                                <a href="#"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
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
                <form class="flex-center" style="gap: 12px;">
                    <input type="text" name="city" id="add-city-text" placeholder="City Name">
                    <div>
                        <button class="cancel btn btn-outline-secondary text-secondary">Cancel</button>
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
                <form class="flex-center" style="gap: 12px;">
                    <input type="text" name="Country" id="add--text" placeholder="Country Name">
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
                <form class="flex-center" style="gap: 12px;">
                    <input type="text" name="continent" id="add-continent-text" placeholder="Continent Name">
                    <div>
                        <button class="cancel btn btn-outline-secondary text-secondary">Cancel</button>
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
                <form class="flex-center" style="gap: 12px;">
                    <input type="text" name="continent" id="add-continent-text" placeholder="Admin Name">
                    <input type="text" name="continent" id="add-continent-text" placeholder="Admin Phone">
                    <input type="text" name="continent" id="add-continent-text" placeholder="Admin Email">
                    <div class="form-control"> <select id="location-select" name="location" id="location">
                            <option value="choose" disabled selected>Select City</option>
                            <option value="usa">USA</option>
                            <option value="india">India</option>
                            <option value="uk">United Kingdom</option>
                            <option value="bangalore">Thailand</option>
                        </select></div>
                    <div>
                        <button class="cancel btn btn-outline-secondary text-secondary">Cancel</button>
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
                <form class="flex-center" style="gap: 12px;">
                    <div class="form-control"> <select id="location-select" name="location" id="location">
                            <option value="choose" disabled selected>Select City</option>
                            <option value="arlington">Arlington</option>
                            <option value="newyork">New York</option>
                            <option value="hongkong">Hong Kong</option>
                            <option value="bangalore">Bangalore</option>
                            <option value="london">London</option>
                            <option value="dubai">Dubai</option>
                        </select></div>
                    <input type="text" name="businessName" id="businessName" placeholder="Place Name">
                    <textarea name="businessDesc" id="businessDesc" cols="30" rows="3" placeholder="Place Descriuption"
                        style="width: 400px;"></textarea>
                    <div class="form-control"> <select id="location-select" name="location" id="location">
                            <option value="choose" disabled selected>Choose a Category</option>
                            <option value="restaurants">Restaurants</option>
                            <option value="shopping">Shopping</option>
                            <option value="education">Education</option>
                            <option value="worship">Religion & Worship</option>
                            <option value="entertainment">Entertainment</option>
                            <option value="health">Health & Medical</option>
                        </select></div>
                    <div>
                        <div>
                            <button class="cancel btn btn-outline-secondary text-secondary">Cancel</button>
                            <button class="btn" type="submit">Add</button>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Faker/3.1.0/faker.min.js"
        integrity="sha512-/seDHxVfh1NvFUscAj8GsHQVZJvr2jjAoYsNL7As2FCaFHUHYIarl3sRCvVlFgyouVNiRgHIebyLKjpgd1SLDw=="
        crossorigin="anonymous"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="../../static/js/admin.js"></script>
</body>

</html>