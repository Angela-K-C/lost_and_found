<?php
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $itemId = $_POST['item_id'];
    $userDescription = trim($_POST['user_description']);

    // Hardcoded user_id until login system is implemented
    $userId = '1';

    // Generate a unique inquiry ID
    $inqId = uniqid();

    // Get current date and time
    $inqDate = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO inquiries (inq_id, user_id, item_id, inq_date, inq_description, status) 
                            VALUES (?, ?, ?, ?, ?, 'pending')");

    if ($stmt) {
        $stmt->bind_param("sssss", $inqId, $userId, $itemId, $inqDate, $userDescription);
        
        if ($stmt->execute()) {
            echo "<p>✅ Inquiry submitted successfully! We'll review it shortly.</p>";
            echo "<a href='./pages/dashboard.php'>⬅ Back to dashboard</a>";
        } else {
            echo "<p>❌ Error submitting inquiry: " . $stmt->error . "</p>";
        }

        $stmt->close();
    } else {
        echo "<p>❌ Query preparation failed: " . $conn->error . "</p>";
    }

    $conn->close();
} else {
    echo "<p>❌ Invalid request method.</p>";
}
?>
