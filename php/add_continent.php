<?php
session_start();
include './functions.php';
if (isset($_POST['continent'])) {   
    $continent = validate($_POST['continent']);
    if(empty($continent)) {
        header("Location: ../pages/admin/super_admin.php?error_msg=Cannot leave continent blank");
        exit();
    } else {
        $conn = get_db_conn();
        $sql = "INSERT INTO continents (continent_name) VALUES ('{$continent}')";
        if ($conn->query($sql) === TRUE) {
            header("Location: ../pages/admin/super_admin.php");
        }
    }

}
?>