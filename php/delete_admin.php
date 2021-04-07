<?php 
    session_start();
    include './functions.php';
    $conn = get_db_conn();
    $sql_del_admin= "delete from country_admins where user_id='{$_GET['id']}'";
    if ($conn->query($sql_del_admin) === TRUE) {
        $sql_del_role = "DELETE from user_roles where user_id='{$_GET['id']}' and role_id='3'";
        if ($conn->query($sql_del_role) === TRUE) { 
            header("Location: ../pages/admin/super_admin.php?msg=success");
        }
    } else {
        header("Location: ../pages/admin/super_admin.php?msg=Something went wrong");

    }
?>