<?php
    session_start();
    require '../connection.php';

    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];

    $sql = "SELECT * FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $username = $user['username'];
    $email = $user['email'];
    $profile_pic = !empty($user['profile_pic']) ? '../' . $user['profile_pic'] : '../assets/images/add_photo.png';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../assets/css/profile.css?v=3" />
    <title>Profile Page</title>
</head>

<body>

<?php include '../includes/navbar.php'; ?>

<h1>Profile Settings</h1>

<div class="container">

  <div class="left">
  <p class="section-title">Profile Picture</p>

  <form method="POST" action="../process_profile.php" enctype="multipart/form-data">
    <div class="upload-area">
      <label for="profilePic">
        <img id="preview" src="<?= $profile_pic ?? '../assets/images/add_photo.png' ?>" />
        <input type="file" name="profilePic" id="profilePic" accept="image/*" onchange="previewImage(event)">
      </label>
    </div>

    <div class="icon-with-text">
      <img src="../assets/images/editing icon.png" width="15" height="15" />
      <span class="icon-text">Edit Profile Picture</span>
    </div>

    <!-- Buttons Row -->
    <div class="button-row">
      <input type="submit" class="yah" value="Save Picture">
  </form>

      <form method="POST" action="log_out.php">
        <input class="yoh" type="submit" value="Log Out">
      </form>
    </div>
</div>


  <!-- Right -->
  <div class="right">
    <form method="POST" action="../process_profile.php" enctype="multipart/form-data" class="form-container">
      <p class="section-title">Personal Details</p>

      <label for="uname">Username</label>
      <input type="text" id="uname" name="uname" class="lbl" value="<?= htmlspecialchars($username) ?>" required>

      <label for="email">Email</label>
      <input type="text" id="email" class="lbl" value="<?= htmlspecialchars($email) ?>" disabled>

      <label for="pword">Password</label>
      <input type="password" id="pword" class="lbl" value="************" disabled>

      <div id="submit-container">
        <button class="yoh" type="button" onclick="window.location.href='dashboard.php'">Cancel</button>
        <input class="yah" type="submit" value="Save Changes">
      </div>
    </form>
  </div>

</div>

<script>
  function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function () {
      document.getElementById('preview').src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  }
</script>



<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            const preview = document.getElementById('preview');
            preview.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

</body>
</html>
