<?php
include '../../php/functions.php';
session_start();

$conn = get_db_conn();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// User doesn't exist
$sql = "INSERT INTO users (full_name, email, password, mobile, profession, nationality, dob, city, address, dp)
VALUES ('{$_SESSION["name"]}', '{$_SESSION["email"]}', '{$_SESSION["pass_hash"]}', '{$_SESSION["phone"]}', '{$_SESSION["profession"]}', '{$_SESSION["nationality"]}' , '{$_SESSION["dob"]}', '{$_SESSION["city"]}', '{$_SESSION["street_addr"]}', 'placeholder.png')";

if ($conn->query($sql) === TRUE) {
    $sql_create_user = "SELECT user_id, full_name, email, mobile, profession, dob, city, address, dp FROM users where email='{$_SESSION["email"]}'";
    $result = $conn->query($sql_create_user);
    if ($result->num_rows > 0) { 
        $row = $result->fetch_assoc();
        $_SESSION["user"] = $row;
        $sql_get_user_city = "SELECT cities.city_id, cities.city_name, countries.country_name FROM cities, countries WHERE cities.country_id=countries.country_id AND cities.city_id='{$row['city']}'";
        $city_result = $conn->query($sql_get_user_city);
        if($city_result->num_rows > 0) {
            $city_row = $city_result->fetch_assoc();
            $_SESSION['user_loc'] = $city_row;
        }
        $sql_set_user_role = "INSERT INTO user_roles (role_id, user_id) values ('{$_SESSION["user_type"]}', '{$row["user_id"]}')";
        if($conn->query($sql_set_user_role) == TRUE) {
            $sql_get_user_roles = "SELECT role_id FROM user_roles where user_id='{$row['user_id']}'";
            $roles_result = $conn->query($sql_get_user_roles);
            $user_roles = [];
            if($roles_result->num_rows > 0) {
                while($item = $roles_result->fetch_assoc()) {
                    array_push($user_roles, $item['role_id']);
                }
                $_SESSION["user_roles"] = $user_roles;
                $from = "Wanderlust";
                $to = $row['email'];
                $subject = "Welcome to Wanderlust!";
                $message = get_email_template($to);
                $headers = "From:" . $from . "\r\n";
                $headers .= "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                mail($to, $subject, $message, $headers);
                header("Location: ../../index.php");
            }
        };
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
