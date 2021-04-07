<?php

session_start();
include './functions.php';

if(isset($_FILES['file']['name'])){

   $filename = $_FILES['file']['name'];
   $db_file_name = $_SESSION['user']['user_id']."_dp_".$filename;
   /* Location */
   $location = "../static/upload/user_dp/".$db_file_name;
   $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
   $imageFileType = strtolower($imageFileType);

   /* Valid extensions */
   $valid_extensions = array("jpg","jpeg","png");

   $response = 0;
   /* Check file extension */
   if(in_array(strtolower($imageFileType), $valid_extensions)) {
      /* Upload file */
      if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
         $conn = get_db_conn();
         $sql = "UPDATE users SET dp='{$db_file_name}' where user_id='{$_SESSION['user']['user_id']}'";
            if ($conn->query($sql) === TRUE) {
               $sql_get_user_deets = "SELECT user_id, full_name, email, password, mobile, profession, dob, city, address, dp FROM users where user_id='{$_SESSION['user']['user_id']}'";
               $user_deets = $conn->query($sql_get_user_deets);
               if($user_deets->num_rows > 0) {
                  $user_row = $user_deets->fetch_assoc();
                  $_SESSION["user"] = $user_row;
               } 
               $response = $location;
            }
      }
   }

   echo $response;
   exit;
}

echo 0;