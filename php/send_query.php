<?php
session_start();
include './functions.php';
if (isset($_POST['query'])) {   
    $fname = validate($_POST['firstName']);
    $lname = validate($_POST['lastName']);
    $country = validate($_POST['country']);
    $email = validate($_POST['email']);
    $phone = validate($_POST['phone']);
    $type = validate($_POST['userType']);
    $query = validate($_POST['query']);
    if(empty($fname)) {
        header("Location: ../pages/main_site/contact.php?error_msg=Cannot leave name blank");
        exit();
    } elseif(empty($lname)) {
        header("Location: ../pages/main_site/contact.php?error_msg=Cannot leave name blank");
        exit();
    } elseif(empty($query)) {
        header("Location: ../pages/main_site/contact.php?error_msg=Cannot leave Query blank");
        exit();
    } else {
        $conn = get_db_conn();
        $sql = "INSERT INTO contact_form (first_name, last_name, country, email, phone, type, query) VALUES ('{$fname}', '{$lname}', '{$country}', '{$email}', '{$phone}', '{$type}', '{$query}')";
        if ($conn->query($sql) === TRUE) {
            $from = "Wanderlust";
            $to = $email;
            $subject = "Thanks for reaching out.";
            $message = get_query_email_template();
            $headers = "From:" . $from . "\r\n";
            $headers .= "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            mail($to, $subject, $message, $headers);
            header("Location: ../pages/main_site/contact.php?msg=success");
        } else {
            header("Location: ../pages/main_site/contact.php?msg=error");
        }
    }

}
?>