<?php
session_start();
require '../connection.php'; // Make sure this points to your DB connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm-password'];

    // Simple validations
    if (empty($username) || empty($email) || empty($password) || empty($confirm)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: ../index.php");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format.";
        header("Location: ../index.php");
        exit();
    }

    if ($password !== $confirm) {
        $_SESSION['error'] = "Passwords do not match.";
        header("Location: ../index.php");
        exit();
    }

    // Check if email or username already exists
    $check = $conn->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
    $check->bind_param("ss", $email, $username);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Email or username already taken.";
        header("Location: ../index.php");
        exit();
    }

    // Store the user
    $user_id = uniqid();
    $role = '2'; // Default role: Student
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (user_id, username, email, password, role) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $user_id, $username, $email, $hashedPassword, $role);

    if ($stmt->execute()) {
        // Success: redirect to login
        $_SESSION['success'] = "Account created! Please log in.";
        header("Location: login.php");
        exit();
    } else {
        $_SESSION['error'] = "Something went wrong. Try again.";
        header("Location: ../index.php");
        exit();
    }
}
?>
