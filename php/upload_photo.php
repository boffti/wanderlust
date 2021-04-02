<?php

session_start();
include './functions.php';

if(isset($_FILES['file']['name'])){

   /* Getting file name */
   $filename = $_FILES['file']['name'];

   /* Location */
   $location = "../static/upload/user_photos/".$_SESSION['user']['user_id']."_".$filename;
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
         $sql = "INSERT INTO user_photos (photo_uri, user_id) VALUES ('{$_SESSION["user"]["user_id"]}_{$filename}', '{$_SESSION["user"]["user_id"]}')";
         if ($conn->query($sql) === TRUE) {
            $response = $location;
         }
      }
   }

   echo $response;
   exit;
}

echo 0;