<?php
    require '../connection.php';

    if (!isset($_GET['user_id'])) {
        echo "User ID not provided.";
        exit();
    }

    $userId = $_GET['user_id'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo "User not found.";
        exit();
    }

    $user = $result->fetch_assoc();

    if (isset($_POST['save_changes'])) {
        $newUsername = $_POST['username'];
        $newEmail = $_POST['email'];
        $newBio = $_POST['bio'];

        $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, bio = ? WHERE user_id = ?");
        $stmt->bind_param("sssi", $newUsername, $newEmail, $newBio, $userId);

        if ($stmt->execute()) {
            header("Location: admin.php");
            exit();
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Users</title>
</head>
<body>
    <form action="" method="POST">
        <h1>Edit User</h1>

        <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['user_id']) ?>">

        <label for="username">Username:</label>
        <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>

        <label for="email">Email:</label>
        <input type="text" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

        <label for="bio">Bio:</label>
        <input type="text" name="bio" value="<?= htmlspecialchars($user['bio']) ?>">

        <button type="submit" name="save_changes">Save Changes</button>
    </form>
</body>
</html>
