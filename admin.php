<?php 
    require '../connection.php';

    if (isset($_POST['toggle_status'])) {
        $userId = $_POST['user_id'];
        $newStatus = $_POST['new_status'];

        $stmt = $conn->prepare("UPDATE users SET status = ? WHERE user_id = ?");
        $stmt->bind_param("ss", $newStatus, $userId); // Both are strings

        if ($stmt->execute()) {
            header("Location: " . $_SERVER['PHP_SELF']); // refresh page
            exit();
        }
    }

    if (isset($_POST['delete_user'])) {

        $userId = $_POST['user_id'];

        //Delete related inquiries
        $stmt1 = $conn->prepare("DELETE FROM inquiries WHERE user_id = ?");
        $stmt1->bind_param("s", $userId); // user_id is a string
        $stmt1->execute();

        // Delete user
        $stmt2 = $conn->prepare("DELETE FROM users WHERE user_id = ?");
        $stmt2->bind_param("s", $userId); // user_id is a string
        if ($stmt2->execute()) {
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "Error deleting user.";
        }
    }

    if (isset($_POST['edit_user'])) {
        header("Location: ./edit_user.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
</head>
<body>
    <h2>ADMIN PAGE</h2>

    <form action="" method="POST">
        <input type="text" placeholder="Search..." name="search" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" />
        <button type="submit">Search</button>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Bio</th>
            <th>Role</th>
            <th>Status</th>
        </tr>

        <?php 
            require '../connection.php';

            // Get search value
            $search = isset($_POST['search']) ? trim($_POST['search']) : '';

            $sql = "SELECT * from users JOIN roles ON users.role = roles.role_id WHERE users.role != 3 AND (users.username LIKE '%$search%' OR role_name LIKE '%$search%')";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                
                while ($row = $result->fetch_assoc()) {

                    echo "
                        <tr>
                            <td>". $row['user_id'] ."</td>
                            <td>". $row['username'] ."</td>
                            <td>". $row['email'] ."</td>
                            <td>". $row['bio'] ."</td>
                            <td>". $row['role_name'] ."</td>
                            <td>". $row['status'] ."</td>

                            <td>
                                <form method='get' action='edit_user.php'>
                                    <input type='hidden' name='user_id' value='" . $row['user_id'] . "'>
                                    <button type='submit'>Edit</button>
                                </form>
                            </td>
                            
                            <td>
                                <form method='post' action='' onsubmit='return confirm(\'Are you sure you want to delete this user?');\'>
                                    <input type='hidden' name='user_id' value='" . $row['user_id'] . "'>
                                    <button type='submit' name='delete_user'>Delete</button>
                                </form>
                            </td>

                            <td>
                                <form method='post' action=''>
                                    <input type='hidden' name='user_id' value='" . $row['user_id'] . "'>
                                    <input type='hidden' name='new_status' value='" . ($row['status'] == 'active' ? 'disabled' : 'active') . "'>
                                    <button type='submit' name='toggle_status'>" . ($row['status'] == 'active' ? 'Disable' : 'Enable') . "</button>
                                </form>
                            </td>
                        </tr>
                    ";

                }

            }
        ?>
    </table>

</body>
</html>