<?php
session_start();
require '../connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['save'])) {
    $user_id = $_SESSION['user_id'];
    $username = $_POST['uname'];
    $email = $_POST['email'];
    $password = $_POST['pword'];
    $profile_pic = '';

    // Optional: fetch current profile pic
    $stmt = $conn->prepare("SELECT profile_pic FROM users WHERE user_id = ?");
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $current = $stmt->get_result()->fetch_assoc();
    $current_profile_pic = $current['profile_pic'] ?? '';
    $stmt->close();

    // Handle file upload if provided
    if (isset($_FILES['profilePic']) && $_FILES['profilePic']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['profilePic']['tmp_name'];
        $fileName = $_FILES['profilePic']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf'];
        $fileSize = $_FILES['profilePic']['size'];

        if (in_array($fileExtension, $allowedExtensions) && $fileSize <= 5 * 1024 * 1024) {
            $newFileName = time() . '_' . basename($fileName);
            $uploadPath = '../uploads/' . $newFileName;

            if (move_uploaded_file($fileTmpPath, $uploadPath)) {
                $profile_pic = 'uploads/' . $newFileName;
            }
        }
    }

    // Use existing profile picture if new one not uploaded
    if (empty($profile_pic)) {
        $profile_pic = $current_profile_pic;
    }

    // Handle password update
    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET username = ?, email = ?, password = ?, profile_pic = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $username, $email, $hashedPassword, $profile_pic, $user_id);
    } else {
        // Don't change password if left blank
        $sql = "UPDATE users SET username = ?, email = ?, profile_pic = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $username, $email, $profile_pic, $user_id);
    }

    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: profile.php");
    exit();
}
