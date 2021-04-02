<?php

function get_db_conn() {
    $servername = "localhost";
    $username = "wl_app";
    $password = "wanderlust@2021";
    $dbname = "wl_p4";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        return null;
    }
    return $conn;
}

?>