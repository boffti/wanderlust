<?php

if (isset($_POST['email']) && isset($_POST["password"])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = validate($_POST['email']);
    $pass = validate($_POST['password']);

    if(empty($email)) {
        header("Location: login.php?error_msg=Cannot leave email blank");
        exit();
    } else if(empty($pass)) {
        header("Location: login.php?error_msg=Cannot leave password blank");
        exit();
    } else {
        echo "Valid Input";
    }

} else {
    header("Location: login.php");
    exit();
}