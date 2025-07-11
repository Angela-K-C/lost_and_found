<?php
require '../connection.php';

// Check if user_id is provided and not empty
if (!isset($_POST['user_id']) || empty(trim($_POST['user_id']))) {
    header("Location: all_users.php?error=invalid_user_id");
    exit();
}

$userId = trim($_POST['user_id']);

try {
    // Start transaction
    $conn->begin_transaction();
    
    // First, check if the status column exists
    $checkColumn = $conn->query("SHOW COLUMNS FROM users LIKE 'status'");
    if ($checkColumn->num_rows === 0) {
        $conn->rollback();
        header("Location: all_users.php?error=status_column_missing");
        exit();
    }
    
    // Check if user exists and get current status
    $checkStmt = $conn->prepare("SELECT username, status FROM users WHERE user_id = ?");
    $checkStmt->bind_param("s", $userId);
    $checkStmt->execute();
    $result = $checkStmt->get_result();
    
    if ($result->num_rows === 0) {
        $conn->rollback();
        header("Location: all_users.php?error=user_not_found");
        exit();
    }
    
    $user = $result->fetch_assoc();
    $username = $user['username'];
    $currentStatus = $user['status'] ?? 'active';
    
    // Toggle status
    $newStatus = ($currentStatus === 'active') ? 'disabled' : 'active';
    $action = ($newStatus === 'disabled') ? 'disabled' : 'enabled';
    
    // Update user status
    $updateStmt = $conn->prepare("UPDATE users SET status = ? WHERE user_id = ?");
    $updateStmt->bind_param("ss", $newStatus, $userId);
    
    if ($updateStmt->execute()) {
        // Commit transaction
        $conn->commit();
        header("Location: all_users.php?success=user_" . $action . "&username=" . urlencode($username));
    } else {
        // Rollback transaction
        $conn->rollback();
        header("Location: all_users.php?error=status_update_failed");
    }
    
} catch (Exception $e) {
    // Rollback transaction on error
    $conn->rollback();
    // Log the actual error for debugging (you can remove this in production)
    error_log("Disable user error: " . $e->getMessage());
    header("Location: all_users.php?error=database_error&details=" . urlencode($e->getMessage()));
} finally {
    // Close statements
    if (isset($checkStmt)) $checkStmt->close();
    if (isset($updateStmt)) $updateStmt->close();
    if (isset($conn)) $conn->close();
}

exit();
?>
