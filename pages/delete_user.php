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
    
    // First, check if user exists and get user details
    $checkStmt = $conn->prepare("SELECT username, role FROM users WHERE user_id = ?");
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
    $userRole = $user['role'];
    
    // Optional: Prevent deleting admin users (uncomment if needed)
    // if ($userRole == '2') {
    //     $conn->rollback();
    //     header("Location: all_users.php?error=cannot_delete_admin");
    //     exit();
    // }
    
    // Delete related records first (if any)
    // Delete user's inquiries
    $deleteInquiries = $conn->prepare("DELETE FROM inquiries WHERE user_id = ?");
    $deleteInquiries->bind_param("s", $userId);
    $deleteInquiries->execute();
    
    // Delete user's claims (if any)
    $deleteClaims = $conn->prepare("DELETE FROM claims WHERE inq_id IN (SELECT inq_id FROM inquiries WHERE user_id = ?)");
    $deleteClaims->bind_param("s", $userId);
    $deleteClaims->execute();
    
    // Finally, delete the user
    $deleteUser = $conn->prepare("DELETE FROM users WHERE user_id = ?");
    $deleteUser->bind_param("s", $userId);
    
    if ($deleteUser->execute()) {
        // Commit transaction
        $conn->commit();
        header("Location: all_users.php?success=user_deleted&username=" . urlencode($username));
    } else {
        // Rollback transaction
        $conn->rollback();
        header("Location: all_users.php?error=delete_failed");
    }
    
} catch (Exception $e) {
    // Rollback transaction on error
    $conn->rollback();
    header("Location: all_users.php?error=database_error");
} finally {
    // Close statements
    if (isset($checkStmt)) $checkStmt->close();
    if (isset($deleteInquiries)) $deleteInquiries->close();
    if (isset($deleteClaims)) $deleteClaims->close();
    if (isset($deleteUser)) $deleteUser->close();
    if (isset($conn)) $conn->close();
}

exit();
?>
