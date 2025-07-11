<?php
require '../connection.php';

// Get and sanitize user ID from query
$userId = trim($_GET['user_id'] ?? '');

// Ensure user ID is not empty
if (empty($userId)) {
    echo "User ID not provided or invalid.";
    exit();
}

// Fetch user info from database
$stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->bind_param("s", $userId);  // user_id is a string
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "User not found.";
    exit();
}

$user = $result->fetch_assoc();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newUsername = $_POST['username'];
    $newEmail = $_POST['email'];
    $newBio = $_POST['bio'] ?? '';
    $newRole = $_POST['role'];

    $update = $conn->prepare("
        UPDATE users 
        SET username = ?, email = ?, bio = ?, role = ? 
        WHERE user_id = ?
    ");
    $update->bind_param("sssss", $newUsername, $newEmail, $newBio, $newRole, $userId);

    if ($update->execute()) {
        header("Location: all_users.php");
        exit();
    } else {
        echo "Error updating user: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Edit User Profile</title>
  <link rel="stylesheet" href="../assets/css/edit_user.css" />
</head>
<body>

  <?php include '../includes/navbar.php'; ?>

  <main class="edit-user-container">
    <h2>Edit User Profile</h2>

    <form action="" method="POST" class="edit-user-form">
      <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['user_id']) ?>">

      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required />
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required />
      </div>

      <div class="form-group">
        <label for="role">User Role</label>
        <select id="role" name="role" required>
          <option value="1" <?= $user['role'] == 1 ? 'selected' : '' ?>>User</option>
          <option value="2" <?= $user['role'] == 2 ? 'selected' : '' ?>>Admin</option>
        </select>
      </div>

      <div class="form-group">
        <label for="bio">User Bio</label>
        <textarea id="bio" name="bio" placeholder="Enter user bio here..."><?= htmlspecialchars($user['bio'] ?? '') ?></textarea>
      </div>

      <div class="form-actions">
        <button type="submit" name="save_changes" class="save-btn">Save Changes</button>
        <button type="button" class="cancel-btn" onclick="window.history.back()">Cancel</button>
      </div>
    </form>
  </main>

</body>
</html>
