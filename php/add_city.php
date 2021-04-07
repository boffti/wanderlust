<?php
session_start();
include './functions.php';
if (isset($_POST['city'])) {   
    $city = validate($_POST['city']);
    $country_id = validate($_POST['country_id']);
    if(empty($city)) {
        header("Location: ../pages/admin/super_admin.php?error_msg=Cannot leave city blank");
        exit();
    } else {
        $conn = get_db_conn();
        $sql = "INSERT INTO cities (city_name, country_id) VALUES ('{$city}', '{$country_id}')";
        if ($conn->query($sql) === TRUE) {
            if(isset($_GET['loc'])){
                header("Location: ../pages/admin/super_admin.php?msg=Success");
            } else {
                header("Location: ../pages/admin/country_admin.php?msg=Success");
            }
        }
    }

}
?>