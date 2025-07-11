<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Edit User Profile</title>
  <link rel="stylesheet" href="../assets/css/edit_user.css" />
</head>
<body>

  <!-- Optional: include navbar -->
  <?php include '../includes/navbar.php'; ?>

  <main class="edit-user-container">
    <h2>Edit User Profile</h2>

    <form action="#" method="POST" class="edit-user-form">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="john_doe" required />
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="john@example.com" required />
      </div>

      <div class="form-group">
        <label for="admission">Admission Number</label>
        <input type="text" id="admission" name="admission_number" value="ADM2023123" required />
      </div>

      <div class="form-group">
        <label for="role">User Role</label>
        <select id="role" name="role">
          <option value="user">User</option>
          <option value="admin">Admin</option>
        </select>
      </div>

      <div class="form-group">
        <label for="bio">User Bio</label>
        <textarea id="bio" name="bio" placeholder="Enter user bio here...">I am a computer science student at KU.</textarea>
      </div>

      <div class="form-actions">
        <button type="submit" class="save-btn">Save Changes</button>
        <button type="button" class="cancel-btn" onclick="window.history.back()">Cancel</button>
      </div>
    </form>
  </main>

</body>
</html>
