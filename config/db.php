<?php

    $host = "localhost";
    $dbName = "rides_project";
    $dbUser = "root";
    $dbPassword = "";  

    try {
        $dsn = "mysql:host={$host};dbname={$dbName};";
        $db_conn = new PDO($dsn, $dbUser, $dbPassword);
        $db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // add through exceptions 
    }catch(PDOException $e) {
        die("Connection error: ". $e->getMessage()) ;
    }
?>