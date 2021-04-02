<?php 
    session_start();
    include './functions.php';

    $conn = get_db_conn();
    $sql_user_tips = "delete from tips where tip_id='{$_GET['tip_id']}'";
    if ($conn->query($sql_user_tips) === TRUE) {
        header("Location: ../pages/user/profile.php");
    }
?>