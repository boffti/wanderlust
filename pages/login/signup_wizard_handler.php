<?php
session_start();
if (isset($_POST['phone']) && isset($_POST["profession"]) && isset($_POST["dob"]) && isset($_POST["nationality"]) && isset($_POST["nationality"]) && isset($_POST["city"])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $phone = validate($_POST['phone']);
    $profession = validate($_POST['profession']);
    $dob = validate($_POST['dob']);
    $nationality = validate($_POST['nationality']);
    $city = validate($_POST['city']);
    $street_addr = validate($_POST['street_addr']);
    $user_type = validate($_POST['user_type']);

    if(empty($phone)) {
        header("Location: login.php?error_msg=Cannot leave Phone Number blank");
        exit();
    } else if(empty($profession)) {
        header("Location: login.php?error_msg=Cannot leave Profession blank");
        exit();
    } else if(empty($dob)) {
        header("Location: login.php?error_msg=Cannot leave Date of Birth blank");
        exit();
    } else if(empty($nationality)) {
        header("Location: login.php?error_msg=Cannot leave Nationality blank");
        exit();
    } else if(empty($city)) {
        header("Location: login.php?error_msg=Cannot leave City blank");
        exit();
    } else if(empty($street_addr)) {
        header("Location: login.php?error_msg=Cannot leave Street Address blank");
        exit();
    } else if(empty($user_type)) {
        header("Location: login.php?error_msg=Cannot leave last option blank");
        exit();
    } else {
        $_SESSION["phone"] = $phone;
        $_SESSION["profession"] = $profession;
        $_SESSION["dob"] = $dob;
        $_SESSION["nationality"] = $nationality;
        $_SESSION["city"] = $city;
        $_SESSION["street_addr"] = $street_addr;
        $_SESSION["user_type"] = $user_type;
        header("Location: register_user.php");
    }

} else {
    // header("Location: ../pages/login/login.php");
    // exit();
    echo("Invalid");
}
