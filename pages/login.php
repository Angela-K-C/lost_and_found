<?php

session_start();
require '../connection.php';
if ($_SERVER['REQUEST_METHOD']== 'POST'){
  $username = $_POST['username'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = stmt->get_result();
  $user = $result->fetch_assoc();

  if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_session['username'] = $user['username'];
    $_session['profile_pic'] = $user['profile_image'];
    
    header("Location: ../pages/dashboard.php");
    exit;
  }else {
    $error = "Invalid username or password.";
  }

}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <title>Registration Form</title>
  </head>
  <body>
    <div class="container">
      <section class="image-panel">
        <img src="../assets/images/heroimage.png" alt="hero section image" />
      </section>


      <form action="../login_handler.php" method="post" class="form-panel">
        <img
          src="../assets/images/smallerimage.png"
          alt="smaller image"
          width="100"
          height="100"
          class="logo-image"
        />

        <fieldset>
          <?php 
            if (!empty($_SESSION['error'])) { 
              echo "<p class='error'>&#9888; " . htmlspecialchars($_SESSION['error']) . "</p>";
              unset($_SESSION['error']);
            }
          ?>

          <label for="username">
            Username
            <input
              class="labels icon-input"
              type="text"
              id="username"
              name="username"
              placeholder="12345"
              required
            />
          </label>

          <label for="password">
            Password
            <input
              class="labels icon-input"
              type="password"
              id="password"
              name="password"
              placeholder="Enter your password"
              required
            />
          </label>

          <input type="submit" value="Login" class="submit" />
          <p>
            Don't have an account?
            <a href="../index.php">Sign up</a>
          </p>
        </fieldset>
              </fieldset>
      </form>
    </div>
  </body>
</html>