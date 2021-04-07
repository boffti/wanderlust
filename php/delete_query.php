<?php 
    session_start();
    include './functions.php';
    $conn = get_db_conn();
    $sql_del_country= "delete from contact_form where query_id='{$_GET['id']}'";
    if ($conn->query($sql_del_country) === TRUE) {
        if(isset($_GET['loc'])) {
            header("Location: ../pages/admin/super_admin.php?msg=success");
        } else {
            header("Location: ../pages/admin/country_admin.php?msg=success");
        }
    }
?>