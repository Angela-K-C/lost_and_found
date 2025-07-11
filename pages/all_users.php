<?php include 'all_users_get.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Users</title>
    <link rel="stylesheet" href="../assets/css/all_users.css">
</head>
<body>
    <?php include '../includes/navbar.php' ?>

    <h1>All Registered Users</h1>

    <!-- Display success/error messages -->
    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">
            <?php if ($_GET['success'] === 'user_deleted'): ?>
                User "<?= htmlspecialchars($_GET['username'] ?? 'Unknown') ?>" has been successfully deleted.
            <?php elseif ($_GET['success'] === 'user_disabled'): ?>
                User "<?= htmlspecialchars($_GET['username'] ?? 'Unknown') ?>" has been successfully disabled.
            <?php elseif ($_GET['success'] === 'user_enabled'): ?>
                User "<?= htmlspecialchars($_GET['username'] ?? 'Unknown') ?>" has been successfully enabled.
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-error">
            <?php 
            switch ($_GET['error']) {
                case 'invalid_user_id':
                    echo "Invalid user ID provided.";
                    break;
                case 'user_not_found':
                    echo "User not found.";
                    break;
                case 'delete_failed':
                    echo "Failed to delete user. Please try again.";
                    break;
                case 'status_update_failed':
                    echo "Failed to update user status. Please try again.";
                    break;
                case 'database_error':
                    echo "Database error occurred. Please try again.";
                    if (isset($_GET['details'])) {
                        echo "<br><small>Error details: " . htmlspecialchars($_GET['details']) . "</small>";
                    }
                    break;
                case 'status_column_missing':
                    echo "Status column is missing from the database. Please run the database migration first.";
                    break;
                case 'cannot_delete_admin':
                    echo "Cannot delete admin users for security reasons.";
                    break;
                default:
                    echo "An error occurred.";
            }
            ?>
        </div>
    <?php endif; ?>

    <!-- 🔍 Search Form -->
    <form method="GET" action="" style="margin-bottom: 20px;">
        <input type="text" name="search" placeholder="Search by username or email..." value="<?= htmlspecialchars($search ?? '') ?>">
        <button type="submit">Search</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Profile Picture</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $count = 1; ?>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $count++ ?></td>
                        <td>
                            <?php if (!empty($row['profile_pic'])): ?>
                                <img class="profile-pic" src="../<?= htmlspecialchars($row['profile_pic']) ?>" alt="Profile Picture">
                            <?php else: ?>
                                No image
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($row['username']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= htmlspecialchars($row['role_name'] ?? 'Unknown') ?></td>
                        <td>
                            <?php 
                            $status = $row['status'] ?? 'active';
                            $statusClass = ($status === 'active') ? 'status-active' : 'status-disabled';
                            $statusText = ($status === 'active') ? 'Active' : 'Disabled';
                            ?>
                            <span class="<?= $statusClass ?>"><?= $statusText ?></span>
                        </td>
                        <td class="action-buttons">
                            <form action="edit_user.php" method="get" style="display:inline;">
                                <input type="hidden" name="user_id" value="<?= $row['user_id'] ?>">
                                <button class="edit-btn" type="submit">Edit</button>
                            </form>
                            <form action="delete_user.php" method="post" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete the user \'<?= htmlspecialchars($row['username']) ?>\'? This action cannot be undone and will also delete all their inquiries.');">
                                <input type="hidden" name="user_id" value="<?= $row['user_id'] ?>">
                                <button class="delete-btn" type="submit">Delete</button>
                            </form>
                            <?php 
                            $currentStatus = $row['status'] ?? 'active';
                            $toggleAction = ($currentStatus === 'active') ? 'Disable' : 'Enable';
                            $confirmMessage = ($currentStatus === 'active') ? 'disable' : 'enable';
                            $buttonClass = ($currentStatus === 'active') ? 'disable-btn' : 'enable-btn';
                            ?>
                            <form action="disable_user.php" method="post" style="display:inline;" onsubmit="return confirm('Are you sure you want to <?= $confirmMessage ?> the user \'<?= htmlspecialchars($row['username']) ?>\'?');">
                                <input type="hidden" name="user_id" value="<?= $row['user_id'] ?>">
                                <button class="<?= $buttonClass ?>" type="submit"><?= $toggleAction ?></button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="7" style="text-align: center;">No users found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>

<?php
if (isset($stmt)) $stmt->close();
if (isset($conn)) $conn->close();
?>
