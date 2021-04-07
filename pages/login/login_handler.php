<?php
include '../../php/functions.php';
if (isset($_POST['email']) && isset($_POST["password"])) {
    $email = validate($_POST['email']);
    $pass = validate($_POST['password']);
    $pass_hash = password_hash($pass, PASSWORD_DEFAULT);

    if(empty($email)) {
        header("Location: login.php?error_msg=Cannot leave email blank");
        exit();
    } else if(empty($pass)) {
        header("Location: login.php?error_msg=Cannot leave password blank");
        exit();
    } else {
        $conn = get_db_conn();
        $sql_check_user = "SELECT password FROM users where email='{$email}'";
        $result = $conn->query($sql_check_user);
        if ($result->num_rows > 0) { 
            $row = $result->fetch_assoc();
            if(password_verify($pass, $row["password"])) {
                session_start();
                $sql_get_user_deets = "SELECT user_id, full_name, email, password, mobile, profession, dob, city, address, dp FROM users where email='{$email}'";
                $user_deets = $conn->query($sql_get_user_deets);
                if($user_deets->num_rows > 0) {
                    $user_row = $user_deets->fetch_assoc();
                    $_SESSION["user"] = $user_row;
                    $sql_get_user_roles = "SELECT role_id FROM user_roles where user_id='{$user_row['user_id']}'";
                    $roles_result = $conn->query($sql_get_user_roles);
                    $user_roles = [];
                    if($roles_result->num_rows > 0) {
                        while($item = $roles_result->fetch_assoc()) {
                            array_push($user_roles, $item['role_id']);
                        }
                        $_SESSION["user_roles"] = $user_roles;
                    }
                    $sql_country_admin = "SELECT u.user_id, c.country_id, c.country_name FROM users as u, country_admins as ca, countries as c where u.user_id=ca.user_id and ca.country_id=c.country_id";
                    $admin_result = $conn->query($sql_country_admin);
                    if($admin_result->num_rows > 0) {
                        $admin_row = $admin_result->fetch_assoc();
                        $_SESSION['country_admin'] = $admin_row;
                    }
                    $sql_get_user_city = "SELECT cities.city_id, cities.city_name, countries.country_name FROM cities, countries WHERE cities.country_id=countries.country_id AND cities.city_id='{$user_row['city']}'";
                    $city_result = $conn->query($sql_get_user_city);
                    if($city_result->num_rows > 0) {
                        $city_row = $city_result->fetch_assoc();
                        $_SESSION['user_loc'] = $city_row;
                    }
                }
                header("Location: ../../index.php");
            } else {
                header("Location: login.php?error_msg=Incorrect Email/Password");
            }
        } else { 
            echo "We didn't find an account. Please register first.";
        }
        $conn->close();
    }

} else {
    header("Location: ../pages/login/login.php?error=Something went wrong");
}
