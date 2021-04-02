<?php
    session_start();

    include './functions.php';
    if (isset($_POST['post_content'])) { 
        function validate($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    
        $post_content = validate($_POST['post_content']);
        if(empty($post_content)) {
            header("Location: ../pages/user/posts.php?error_msg=Cannot leave post content blank");
            exit();
        } else {
            $conn = get_db_conn();
            $sql = "INSERT INTO posts (user_id, city_id, post_content) VALUES ('{$_SESSION["user"]["user_id"]}', '{$_SESSION["user_loc"]["city_id"]}', '{$post_content}')";
            if ($conn->query($sql) === TRUE) {
                if($_POST['loc'] == '1') {
                    header("Location: ../index.php");
                } else {
                    header("Location: ../pages/user/posts.php");
                }
            }
        }

    }
?>