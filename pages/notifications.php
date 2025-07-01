<?php
session_start();
include '../connection.php';

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role']; 


if ($role === '1') {
  $query = "SELECT * FROM notifications WHERE role = '1' ORDER BY created_at DESC";
} else {
  $query = "SELECT * FROM notifications WHERE role = '2' AND user_id = '$user_id' ORDER BY created_at DESC";
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Notifications</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../assets/css/notifications.css" />
  <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet" />
</head>
<body>

  <?php include '../includes/navbar.php'; ?>

  <div class="notifications-container">
    <h2>Notifications</h2>

    <div class="notification-feed">
      <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
          <div class="notification-item">
            <span class="icon">🔔</span>
            <div class="details">
              <div class="title"><?= htmlspecialchars($row['title']) ?></div>
              <div class="message"><?= htmlspecialchars($row['message']) ?></div>
            </div>
            <div class="timestamp">
              <?= date("M j, Y g:i A", strtotime($row['created_at'])) ?>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p style="color: #777; font-style: italic;">No notifications yet.</p>
      <?php endif; ?>
    </div>

  </div>

</body>
</html>
