<?php 
    session_start();
    include './functions.php';

    $conn = get_db_conn();
    $sql_user_tips = "delete from tips where tip_id='{$_GET['tip_id']}'";
    if ($conn->query($sql_user_tips) === TRUE) {
        if(isset($_GET['loc'])) {
            header("Location: ../pages/admin/super_admin.php?msg=tip_deleted");
        } else {
            header("Location: ../pages/user/profile.php?msg=tip_deleted");
        }
    } else {
        if(isset($_GET['loc'])) {
            header("Location: ../pages/admin/super_admin.php?msg=Error");
        } else {
            header("Location: ../pages/user/profile.php?msg=Error");
        }
    }
?>