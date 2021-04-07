<?php 
    session_start();
    include './functions.php';
    $user_id = $_GET['id'];
    $conn = get_db_conn();
    // Delete photos
    $sql_del_photos = "delete from user_photos where user_id='{$user_id}'";
    // Delete Videos
    $sql_del_videos = "delete from user_videos where user_id='{$user_id}'";
    // Delete roles
    $sql_del_roles = "delete from user_roles where user_id='{$user_id}'";
    // Delete country admin role
    $sql_del_country_admin_role = "delete from country_admins where user_id='{$user_id}'";
    // Delete User
    $sql_del_user= "delete from users where user_id='{$user_id}'";

    if ($conn->query($sql_del_photos) === TRUE) {
        if ($conn->query($sql_del_videos) === TRUE) {
            if ($conn->query($sql_del_roles) === TRUE) {
                if ($conn->query($sql_del_country_admin_role) === TRUE) {
                    if ($conn->query($sql_del_user) === TRUE) {
                        header("Location: ../pages/admin/super_admin.php?msg=User Deleted");
                    }
                } else {
                    header("Location: ../pages/admin/super_admin.php?msg=Unable to delete country admin role");
                }
            } else {
                header("Location: ../pages/admin/super_admin.php?msg=Unable to delete user roles");
            }
        } else {
            header("Location: ../pages/admin/super_admin.php?msg=Unable to delete user videos");
        }
    } else {
        header("Location: ../pages/admin/super_admin.php?msg=Unable to delete user photos");
    }
    
?>