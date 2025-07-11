<?php
session_start();
require './connection.php';

// Simple test for file upload
if ($_POST) {
    echo "<h3>POST Data:</h3>";
    var_dump($_POST);
    echo "<h3>FILES Data:</h3>";
    var_dump($_FILES);
    echo "<h3>Session Data:</h3>";
    var_dump($_SESSION);
    
    if (isset($_FILES['profilePic'])) {
        $file = $_FILES['profilePic'];
        echo "<h3>File Details:</h3>";
        echo "Name: " . $file['name'] . "<br>";
        echo "Type: " . $file['type'] . "<br>";
        echo "Size: " . $file['size'] . "<br>";
        echo "Error: " . $file['error'] . "<br>";
        echo "Tmp Name: " . $file['tmp_name'] . "<br>";
        
        if ($file['error'] == 0) {
            echo "<h3>File upload looks good!</h3>";
            $uploadDir = "uploads/";
            $fileName = time() . "_test_" . basename($file['name']);
            $uploadPath = $uploadDir . $fileName;
            
            if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                echo "<h3>File uploaded successfully to: " . $uploadPath . "</h3>";
            } else {
                echo "<h3>Failed to move uploaded file</h3>";
            }
        } else {
            echo "<h3>File upload error: " . $file['error'] . "</h3>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Test</title>
</head>
<body>
    <h2>Profile Picture Upload Test</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="profilePic" accept="image/*" required>
        <button type="submit">Test Upload</button>
    </form>
</body>
</html>
