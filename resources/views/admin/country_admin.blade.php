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
    <title>WL | Admin</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="../../static/css/style.css">
    <link rel="stylesheet" href="../../static/css/gabriel.css">
</head>

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
            <h1 class="ml-10">Manage <?php echo $_SESSION['country_admin']['country_name']?></h1>
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
                                $sql_get_cities = "SELECT city_id, city_name from cities where country_id={$_SESSION['country_admin']['country_id']}";
                                $cities = $conn->query($sql_get_cities);
                                if($cities->num_rows > 0) {                          
                                    $html_template = "";
                                    while($item = $cities->fetch_assoc()) {
                                        echo <<<cities
                                        <tr>
                                            <td>{$item['city_name']}</td>
                                            <td>
                                                <a href="../../php/delete_city.php?id={$item['city_id']}"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                        cities;
                                    }
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="flex-left space-between">
                        <div class="card">
                            <h3>Statistic 2</h3>
                            <canvas id="chart2"></canvas>
                        </div>
                    </div>
                </div>

            </div>

            <div class="card">
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
                            $sql_get_poi = "SELECT b.business_id, b.business_name, b.business_website, b.business_desc, b.business_phone, b.business_address, b.photo_uri, c.city_id, c.city_name, cat.category_id, cat.category_name from business as b, cities as c, categories as cat where b.city_id=c.city_id and b.category=cat.category_id and c.country_id={$_SESSION['country_admin']['country_id']}";
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
                                            <a href="../../php/delete_poi.php?id={$item['business_id']}"><i class="fas fa-trash-alt"></i></a>
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
                            $sql_get_posts = "SELECT p.post_id, p.post_content, p.created_at, u.full_name, c.city_name from posts as p, users as u, cities as c where p.user_id=u.user_id and p.city_id=c.city_id and c.country_id={$_SESSION['country_admin']['country_id']}";
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
                                            <a href="../../php/delete_post.php?id={$item['post_id']}"><i class="fas fa-trash-alt"></i></a>
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
                            $sql_get_tips = "SELECT t.tip_id, t.tip_content, u.full_name, c.city_name from tips as t, users as u, cities as c where t.user_id=u.user_id and t.city_id=c.city_id and c.country_id={$_SESSION['country_admin']['country_id']}";
                            $tips = $conn->query($sql_get_tips);
                            if($tips->num_rows > 0) {                          
                                while($item = $tips->fetch_assoc()) {
                                    echo <<<users
                                    <tr>
                                        <td>{$item['city_name']}</td>
                                        <td>{$item['full_name']}</td>
                                        <td>{$item['tip_content']}</td>
                                        <td>
                                            <a href="../../php/delete_tip.php?tip_id={$item['tip_id']}"><i class="fas fa-trash-alt"></i></a>
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
                <form action="../../php/add_city.php" method="post" class="flex-center" style="gap: 12px;">
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

    <!-- Add POI Modal -->
    <div id="add-poi-modal-container" class="modal-container">
        <div class="modal" id="add-poi-modal">
            <div class="modal-header flex-left space-between" style="align-items: center;">
                <p style="margin-left: 12px;">Add Place of Interest</p>
                <a href="#" class="cancel" style="float: right;">x</a>
            </div>
            <div class="modal-content" style="align-items:center;">
                <form class="flex-column" style="gap: 12px;">
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
                    <textarea name="businessDesc" id="businessDesc" cols="30" rows="3" placeholder="Place Description"
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
    <script>
        var ctx2 = document.getElementById('chart2').getContext('2d');
        var myDoughnutChart = new Chart(ctx2, {
            type: 'doughnut',
            data: {
                datasets: [{
                    backgroundColor: [
                        "#2ecc71",
                        "#3498db",
                        "#95a5a6",
                        "#9b59b6",
                        "#f1c40f",
                        "#e74c3c",
                        "#34495e"
                    ],
                    data: [12, 19, 3, 17, 28, 24, 7]
                }]
            }
        });
    </script>
</body>

</html>