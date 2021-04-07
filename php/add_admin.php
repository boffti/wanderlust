<?php
session_start();
include './functions.php';
if (isset($_POST['admin_email'])) {   
    $admin_email = validate($_POST['admin_email']);
    $country_id = validate($_POST['country_id']);
    if(empty($admin_email)) {
        header("Location: ../pages/admin/super_admin.php?error_msg=Cannot leave admin email blank");
        exit();
    } else {
        $conn = get_db_conn();
        $sql_get_user = "SELECT user_id FROM users WHERE email='{$admin_email}'";
        $user = $conn->query($sql_get_user);
        if($user->num_rows > 0) {                          
            $row = $user->fetch_assoc();
        } else {
            header("Location: ../pages/admin/super_admin.php?msg=User doesn't exist");
        }
        $sql_check_admin = "SELECT user_id FROM country_admins WHERE user_id='{$row['user_id']}'";
        $result = $conn->query($sql_check_admin);
        if ($result->num_rows > 0) { 
            // admin exists
            $sql_delete_admin = "DELETE from country_admins where user_id='{$row['user_id']}'";
            $conn->query($sql_delete_admin);
        }
        $sql = "INSERT INTO country_admins (user_id, country_id) VALUES ('{$row['user_id']}', '{$country_id}')";
        if ($conn->query($sql) === TRUE) {
            $sql_add_role = "INSERT INTO user_roles (role_id, user_id) VALUES ('3', '{$row['user_id']}')";
            if ($conn->query($sql_add_role) === TRUE) {
                header("Location: ../pages/admin/super_admin.php?msg=success");
            }
        }
    }

}
?>