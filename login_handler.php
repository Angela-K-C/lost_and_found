<?php
    session_start();
    require "connection.php";

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Get user from username
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        // Check if password is the same as the entered password 
        // TODO: hash password
        if ($row = $result->fetch_assoc()) {
            if (password_verify($password, $row['password'])) {

                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['profile_pic'] = $row['profile_pic'];
 
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