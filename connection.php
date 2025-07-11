<?php 
    // Hide PHP warnings and notices from users (keep errors for development)
    error_reporting(E_ERROR | E_PARSE);
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
    ini_set('error_log', __DIR__ . '/error.log');
    
    // Database credentials
    $host = "localhost";
    $username = "root";
    $password = "asert";
    $database = "lost_and_found";

    // Create connection
    $conn = new mysqli($host, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: ".$conn->connect_error);
    }

    // echo "Connected successfully"."<br>"
?>