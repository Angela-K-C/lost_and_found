<?php
session_start();
require_once '../connection.php';

if (!isset($_SESSION['user_id']) || !isset($_GET['id'])) {
    header("Location: inquiries.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role_name'];
$inquiry_id = (int)$_GET['id'];

// Fetch inquiry and item info
$stmt = $conn->prepare(
    "SELECT inquiries.*, items.item_name, items.location, items.date_located, items.category_id, items.item_id
     FROM inquiries
     JOIN items ON inquiries.item_id = items.item_id
     WHERE inquiries.inquiry_id = ?"
);
$stmt->bind_param("i", $inquiry_id);
$stmt->execute();
$inquiry = $stmt->get_result()->fetch_assoc();

if (!$inquiry) {
    die("Inquiry not found.");
}

// Only allow owner or admin
if ($role !== 'Admin' && $inquiry['user_id'] != $user_id) {
    die("Unauthorized.");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_name = trim($_POST['item_name']);
    $location = trim($_POST['location']);
    $date_located = trim($_POST['date_located']);
    $status = trim($_POST['status']);

    // Update items table
    $stmt = $conn->prepare("UPDATE items SET item_name=?, location=?, date_located=? WHERE item_id=?");
    $stmt->bind_param("sssi", $item_name, $location, $date_located, $inquiry['item_id']);
    $stmt->execute();

    // Update inquiries table (status only for admin)
    if ($role === 'Admin') {
        $stmt = $conn->prepare("UPDATE inquiries SET status=? WHERE inquiry_id=?");
        $stmt->bind_param("si", $status, $inquiry_id);
        $stmt->execute();
    }

    header("Location: ../pages/inquiries.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Inquiry</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css" />
</head>
<body>
    <div class="edit-inquiry-form">
        <h2>Edit Inquiry</h2>
        <form method="POST">
            <label>Item Name:</label>
            <input type="text" name="item_name" value="<?= htmlspecialchars($inquiry['item_name']) ?>" required><br>
            <label>Location:</label>
            <input type="text" name="location" value="<?= htmlspecialchars($inquiry['location']) ?>" required><br>
            <label>Date Located:</label>
            <input type="date" name="date_located" value="<?= htmlspecialchars($inquiry['date_located']) ?>" required><br>
            <?php if ($role === 'Admin'): ?>
                <label>Status:</label>
                <select name="status">
                    <option value="pending" <?= $inquiry['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="approved" <?= $inquiry['status'] == 'approved' ? 'selected' : '' ?>>Approved</option>
                    <option value="rejected" <?= $inquiry['status'] == 'rejected' ? 'selected' : '' ?>>Rejected</option>
                </select><br>
            <?php endif; ?>
            <button type="submit">Save Changes</button>
            <a href="../pages/inquiries.php">Cancel</a>
        </form>
    </div>
</body>
</html>