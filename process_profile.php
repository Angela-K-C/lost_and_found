<?php
    session_start();
    require './connection.php';

    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $username = $_POST['uname'];
    $email = $_POST['email'];
    $profile_pic = '';


    $file = $_FILES['profilePic'];

    $tmpName = $file['tmp_name'];
    $fileName = time() . "_" . basename($file['name']);
    $fileSize = $file['size'];
    $uploadDir = "uploads/";
    $uploadPath = $uploadDir . $fileName;

    // Check file size (max 5MB)
    if ($fileSize > 5 * 1024 * 1024) {
        echo "File is too large. Maximum allowed size is 5MB.";
        exit;
    }

    // Save the file
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Create folder if not exists
    }

    if (move_uploaded_file($tmpName, $uploadPath)) {

        // Update user
        $sql = "UPDATE users SET username = ?, profile_pic = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $uploadPath, $user_id);

        if ($stmt->execute()) {
            echo "<script>alert('User updated successfully!'); window.location.href='./pages/profile.php'</script>";
            $_SESSION['profile_pic'] = $uploadPath;
            exit;
        } else {
            echo "<script>alert('Database error: " . $stmt->error . "')</script>Database error: ";
            exit;
        }
    } else {
        echo "<script>Failed to upload image.</script>";
        exit;
    }

    ?>
