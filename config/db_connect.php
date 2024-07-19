<?php

    require_once 'db_create.php';

    $host = 'localhost';
    $user = 'root';
    $password = '';
    $db_name = 'pokedopt';

    // Connect to Database
    $conn = mysqli_connect($host, $user , $password, $db_name);

    // Check Connection
    if (!$conn) {
        die('Connection failed: ' . $conn->connect_error);
    }
    
?>