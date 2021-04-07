<?php
session_start();
include './functions.php';
if (isset($_POST['country'])) {   
    $country = validate($_POST['country']);
    $cont_id = validate($_POST['continent_id']);
    if(empty($country)) {
        header("Location: ../pages/admin/super_admin.php?error_msg=Cannot leave country blank");
        exit();
    } else {
        $conn = get_db_conn();
        $sql = "INSERT INTO countries (country_name, countinent_id) VALUES ('{$country}', '{$cont_id}')";
        if ($conn->query($sql) === TRUE) {
            header("Location: ../pages/admin/super_admin.php");
        }
    }

}
?>