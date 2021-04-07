<?php 
    session_start();
    include './functions.php';

    $conn = get_db_conn();
    $sql_del_post = "delete from posts where post_id='{$_GET['id']}'";
    if ($conn->query($sql_del_post) === TRUE) {
        if(isset($_GET['loc'])) {
            header("Location: ../pages/admin/super_admin.php?msg=post_deleted");
        } else {
            header("Location: ../pages/user/profile.php?msg=post_deleted");
        }
    } else {
        if(isset($_GET['loc'])) {
            header("Location: ../pages/admin/super_admin.php?msg=Error");
        } else {
            header("Location: ../pages/user/profile.php?msg=Error");
        }
    }
?>