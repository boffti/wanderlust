<?php
session_start();
include './functions.php';
if (isset($_POST['businessName'])) {   
    $city_id = validate($_POST['city_id']);
    $businessName = validate($_POST['businessName']);
    $businessWebsite = validate($_POST['businessWebsite']);
    $businessDesc = validate($_POST['businessDesc']);
    $businessPhone = validate($_POST['businessPhone']);
    $businessAddress = validate($_POST['businessAddress']);
    $photoURI = validate($_POST['photoURI']);
    $category_id = validate($_POST['category_id']);
    if(empty($businessName)) {
        header("Location: ../pages/admin/super_admin.php?error_msg=Cannot leave Name blank");
        exit();
    } else {
        $conn = get_db_conn();
        $sql = "INSERT INTO business (business_name, business_website, business_desc, business_phone, business_address, city_id, category, photo_uri) VALUES ('{$businessName}', '{$businessWebsite}', '{$businessDesc}', '{$businessPhone}', '{$businessAddress}', '{$city_id}', '{$category_id}', '{$photoURI}')";
        if ($conn->query($sql) === TRUE) {
            header("Location: ../pages/admin/super_admin.php?msg=Location added successfully");
        } else {
            echo "Something wrong";
        }
    }

}
?>