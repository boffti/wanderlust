<?php 
    session_start();
    include './functions.php';
    $conn = get_db_conn();
    $sql_del_cont= "delete from continents where continent_id='{$_GET['id']}'";
    if ($conn->query($sql_del_cont) === TRUE) {
        header("Location: ../pages/admin/super_admin.php");
    } else {
        header("Location: ../pages/admin/super_admin.php?msg=Cannot delete continent. It is FK in other tables");
    }
?>