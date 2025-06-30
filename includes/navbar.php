<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/css/navbar.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Kaushan+Script&family=Leckerli+One&display=swap" rel="stylesheet">
</head>
<body>
  <header class="navbar">
    <div class="logo">
      <img src="../assets/images/Ellipse 3.png" alt="Logo" />LI-FI 
    </div>

    <nav class="nav-links">
      <a href="../pages/dashboard.php">Dashboard</a>
      <a href="../pages/inquiries.php">Inquiries</a>
      <a href="../pages/notifications.php">Notifications</a>
    </nav>
    <div class="profile">
      <a href="../pages/profile.php">

        <?php 
           $defaultImage = '../assets/images/default.png';
  $relativeImagePath = isset($_SESSION['profile_pic']) ? $_SESSION['profile_pic'] : $defaultImage;
  $imagePath = strpos($relativeImagePath, 'uploads/') !== false 
               ? '/lost_and_found/' . htmlspecialchars($relativeImagePath)
               : htmlspecialchars($relativeImagePath);

  echo "<img src='$imagePath' alt='Profile Picture' />";
        ?>

        <span style="text-decoration: none;">
          <?= htmlspecialchars($_SESSION['username'] ?? 'Guest') ?>
        </span>


      </a>
    </div>
  </header>
</body>
</html>