<?php
session_start();
require 'connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: pages/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Check if this is a profile picture upload
if (isset($_FILES['profilePic']) && $_FILES['profilePic']['error'] == 0) {
    
    $file = $_FILES['profilePic'];
    $tmpName = $file['tmp_name'];
    $fileName = time() . "_" . basename($file['name']);
    $fileSize = $file['size'];
    $uploadDir = "uploads/";
    $uploadPath = $uploadDir . $fileName;

    // Check file size (max 5MB)
    if ($fileSize > 5 * 1024 * 1024) {
        echo "<script>alert('File is too large. Maximum allowed size is 5MB.'); window.location.href='pages/profile.php';</script>";
        exit;
    }

    // Validate file type
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $tmpName);
    finfo_close($finfo);
    
    if (!in_array($mimeType, $allowedTypes)) {
        echo "<script>alert('Invalid file type. Please upload an image (JPEG, PNG, GIF, or WebP).'); window.location.href='pages/profile.php';</script>";
        exit;
    }

    // Create upload directory if it doesn't exist
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Delete old profile picture if it exists
    $sql = "SELECT profile_pic FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    if (!empty($user['profile_pic']) && file_exists($user['profile_pic'])) {
        unlink($user['profile_pic']);
    }

    if (move_uploaded_file($tmpName, $uploadPath)) {
        // Update only profile picture
        $sql = "UPDATE users SET profile_pic = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $uploadPath, $user_id);

        if ($stmt->execute()) {
            $_SESSION['profile_pic'] = $uploadPath;
            echo "<script>alert('Profile picture updated successfully!'); window.location.href='pages/profile.php';</script>";
        } else {
            echo "<script>alert('Database error: Could not update profile picture.'); window.location.href='pages/profile.php';</script>";
        }
    } else {
        echo "<script>alert('Failed to upload image. Please try again.'); window.location.href='pages/profile.php';</script>";
    }
}
// Handle personal details update
elseif (isset($_POST['uname'])) {
    $username = trim($_POST['uname']);
    
    if (empty($username)) {
        echo "<script>alert('Username cannot be empty.'); window.location.href='pages/profile.php';</script>";
        exit;
    }

    // Check if username already exists (excluding current user)
    $sql = "SELECT user_id FROM users WHERE username = ? AND user_id != ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo "<script>alert('Username already exists. Please choose a different username.'); window.location.href='pages/profile.php';</script>";
        exit;
    }

    // Update username only
    $sql = "UPDATE users SET username = ? WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $user_id);

    if ($stmt->execute()) {
        $_SESSION['username'] = $username;
        echo "<script>alert('Profile updated successfully!'); window.location.href='pages/profile.php';</script>";
    } else {
        echo "<script>alert('Database error: Could not update profile.'); window.location.href='pages/profile.php';</script>";
    }
}
else {
    echo "<script>alert('No data received.'); window.location.href='pages/profile.php';</script>";
}
?>