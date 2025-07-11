<?php
    session_start();
    require "connection.php";

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Get user from username with role information
    $stmt = $conn->prepare("SELECT u.*, r.role_name FROM users u LEFT JOIN roles r ON u.role = r.role_id WHERE u.username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        // Check if password is the same as the entered password 
        if ($row = $result->fetch_assoc()) {
           if (password_verify($password, $row['password'])) {

                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['profile_pic'] = $row['profile_pic'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['role_name'] = $row['role_name'];
               
                // Redirect to dashboard
                header('Location: ./pages/dashboard.php');
                exit;

            } else {
                $_SESSION['error'] = "Invalid password.";
                header("Location: ./pages/login.php");
                exit;
            }
        }

    } else {
        $_SESSION['error'] = "User does not exist.";
        header("Location: ./pages/login.php");
        exit;
    }
?>