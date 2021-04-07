<?php
    session_start();

    include './functions.php';
    if (isset($_POST['tip_content'])) {   
        $tip_content = validate($_POST['tip_content']);
        if(empty($tip_content)) {
            header("Location: ../pages/user/tips.php?error_msg=Cannot leave tip content blank");
            exit();
        } else {
            $conn = get_db_conn();
            $sql = "INSERT INTO tips (tip_content, user_id, city_id) VALUES ('{$tip_content}', '{$_SESSION["user"]["user_id"]}', '{$_SESSION["user_loc"]["city_id"]}')";
            if ($conn->query($sql) === TRUE) {
                header("Location: ../pages/user/tips.php");
            }
        }

    }
?>