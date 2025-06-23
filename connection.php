<?php 
    // Database credentials
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "lost_and_found";

    // Create connection
    $conn = new mysqli($host, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: ".$conn->connect_error);
    }

    // echo "Connected successfully"."<br>"
?>