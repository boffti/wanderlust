<?php 
    session_start();
    include './functions.php';
    $conn = get_db_conn();
    $sql_del_country= "delete from countries where country_id='{$_GET['id']}'";
    if ($conn->query($sql_del_country) === TRUE) {
        header("Location: ../pages/admin/super_admin.php");
    } else {
        header("Location: ../pages/admin/super_admin.php?msg=Cannot delete country. It is FK in other tables");
    }
?>