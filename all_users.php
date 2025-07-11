<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>All Users</title>
  <link rel="stylesheet" href="../assets/css/all_users.css" />
</head>
<body>

  <p>Hello??</p>

  <main class="container">
    <h2>All Registered Users</h2>

    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Username</th>
          <th>Email</th>
          <th>Admission No.</th>
          <th>Role</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td><a href="edit_user_static.html">john_doe</a></td>
          <td>john@example.com</td>
          <td>ADM123456</td>
          <td>User</td>
          <td>
            <button class="edit">Edit</button>
            <button class="disable">Disable</button>
            <button class="delete">Delete</button>
          </td>
        </tr>
        <tr>
          <td>2</td>
          <td><a href="edit_user_static.html">mary_jane</a></td>
          <td>mary@example.com</td>
          <td>ADM987654</td>
          <td>Admin</td>
          <td>
            <button class="edit">Edit</button>
            <button class="disable">Disable</button>
            <button class="delete">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </main>

</body>
</html>
