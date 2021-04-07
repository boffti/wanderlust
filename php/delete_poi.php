<?php 
    session_start();
    include './functions.php';
    $conn = get_db_conn();
    $sql_del_poi= "delete from business where business_id='{$_GET['id']}'";
    if ($conn->query($sql_del_poi) === TRUE) {
        if(isset($_GET['loc'])) {
            header("Location: ../pages/admin/super_admin.php?msg=Success");
        } else {
            header("Location: ../pages/admin/country_admin.php?msg=Success");
        }
        
    } else {
        if(isset($_GET['loc'])) {
            header("Location: ../pages/admin/super_admin.php?msg=Error");
        } else {
            header("Location: ../pages/admin/country_admin.php?msg=Error");
        }
    }
?>