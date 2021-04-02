<?php
include '../../php/functions.php';

session_start();
if (isset($_POST['name']) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["reenter-password"])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $pass = validate($_POST['password']);
    $re_pass = validate($_POST['reenter-password']);

    function isExists($email) {
        $conn = get_db_conn();

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql_check_user = "SELECT user_id, email, full_name FROM users where email='{$email}'";
        $result = $conn->query($sql_check_user);
        if ($result->num_rows > 0) { 
            return true;
        } else { 
            return false;
        }
        $conn->close();
    }

    if(empty($name)) {
        header("Location: login.php?error_msg=Cannot leave Name blank");
        exit();
    } else if(empty($email)) {
        header("Location: login.php?error_msg=Cannot leave Email blank");
        exit();
    } else if(empty($pass)) {
        header("Location: login.php?error_msg=Cannot leave password blank");
        exit();
    } else if(empty($re_pass)) {
        header("Location: login.php?error_msg=Cannot leave password blank");
        exit();
    } else {
        if($pass == $re_pass) {
            if(!isExists($email)) {
                $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
                $_SESSION["name"] = $name;
                $_SESSION["email"] = $email;
                $_SESSION["pass_hash"] = $pass_hash;
                header("Location: signup_wizard.php");
            } else {
                echo("You already have an account with us. Please sign in instead.");
            }
        } else {
            echo("Passwords don't match!");
        }
    }

} else {
    // header("Location: ../pages/login/login.php");
    // exit();
    echo("Invalid");
}

?>