<?php
session_start();
include './functions.php';
$conn = get_db_conn();
$sql_user_count= "SELECT COUNT(*) from users";
$users = $conn->query($sql_user_count);
$user_count = $users->fetch_row();

$sql_posts_count= "SELECT COUNT(*) from posts";
$posts = $conn->query($sql_posts_count);
$post_count = $posts->fetch_row();

$sql_poi_count= "SELECT COUNT(*) from business";
$poi = $conn->query($sql_poi_count);
$poi_count = $poi->fetch_row();

$sql_tips_count= "SELECT COUNT(*) from tips";
$tips = $conn->query($sql_tips_count);
$tips_count = $tips->fetch_row();

$data = array($user_count[0], $post_count[0], $poi_count[0], $tips_count[0]);

echo json_encode($data);
?>