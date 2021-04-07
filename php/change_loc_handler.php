<?php
    session_start();
    include './functions.php';
    if (isset($_POST['location'])) { 
        $location = validate($_POST['location']);
        if(empty($location)) {
            header("Location: ../pages/user/tips.php?error_msg=Cannot leave tip content blank");
            exit();
        } else {
            $conn = get_db_conn();
            $sql = "UPDATE users SET city='{$location}' where user_id='{$_SESSION['user']['user_id']}'";
            if ($conn->query($sql) === TRUE) {
                $sql_get_user_deets = "SELECT user_id, full_name, email, password, mobile, profession, dob, city, address, dp FROM users where user_id='{$_SESSION['user']['user_id']}'";
                $user_deets = $conn->query($sql_get_user_deets);
                if($user_deets->num_rows > 0) {
                    $user_row = $user_deets->fetch_assoc();
                    $_SESSION["user"] = $user_row;
                }
                $sql_get_user_city = "SELECT cities.city_id, cities.city_name, countries.country_name FROM cities, countries WHERE cities.country_id=countries.country_id AND cities.city_id='{$user_row['city']}'";
                $city_result = $conn->query($sql_get_user_city);
                if($city_result->num_rows > 0) {
                    $city_row = $city_result->fetch_assoc();
                    $_SESSION['user_loc'] = $city_row;
                }
                header("Location: ../index.php");
            }
        }

    }
?>