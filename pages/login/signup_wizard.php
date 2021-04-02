<!-- 
    Author: Melkot, Aaneesh Naagaraj
    ID : 1001750503
-->
<?php
session_start();
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="../../static/favicon.ico" />
    <title>Wanderlust | Signup Wizard</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="../../static/css/style.css">
    <link rel="shortcut icon" href="">
</head>

<body>
    <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <div class="signup-page">
        <div class="grid grid-2">
            <a href="../../">
                <img class="signup-img" src="../../static/img/suitcases.jpg" alt="">
            </a>
            <div class="signup-form flex-vertical">
                <img src="../../static/img/destination.png" alt="" style="width: 100px;" class="">
                <div class="card">
                    <div class="flex-vertical">
                        <h1 class="login-heading">You're almost home
                            <?php echo (explode(" ", $_SESSION['name'])[0]); ?>
                        </h1>
                        <p class="login-heading mb-4">We just need some more info to get you started.</p>
                    </div>
                    <form role="form" action="signup_wizard_handler.php" method="post">
                        <div class="">
                            <input name="phone" type="text" id="profession" class="" placeholder="Phone Number" autofocus>
                        </div>
                        <div class="">
                            <input name="profession" type="text" id="profession" class="" placeholder="Profession" required>
                        </div>
                        <div class="">
                            <input name="dob" type="text" id="dob" class="" placeholder="Date of birth : mm/dd/yy" required pattern="[0-1][0-9]/[0-3][0-9]/[0-9][0-9]">
                        </div>
                        <div class="">
                            <input name="nationality" type="text" id="nationality" class="" placeholder="Nationality*" required>
                        </div>
                        <div class="form-control"> <select name="city" id="city">
                                <option value="choose" disabled selected>Where are you moving to?</option>
                                <option value="1">Arlington</option>
                                <option value="2">New York</option>
                                <option value="3">San Fransisco</option>
                                <option value="4">Bangalore</option>
                                <option value="5">Mumbai</option>
                                <option value="6">Hong Kong</option>
                            </select>
                        </div>
                        <div class="">
                            <input name="street_addr" type="text" id="street_addr" class="" placeholder="Street Address">
                        </div>
                        <div class="form-control"> <select name="user_type" id="user_type">
                                <option value="choose" disabled selected>Are you migrating or visiting this city?</option>
                                <option value="1">I'm migrating!</option>
                                <option value="2">Just visiting</option>

                            </select>
                        </div>
                        <br>
                        <button class="btn btn-lg" type="submit">COMPLETE SIGN UP</button>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="./static/js/app.js"></script>
</body>

</html>