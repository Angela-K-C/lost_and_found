<?php
require 'connection.php';

if (isset($_POST['inq_id'], $_POST['action'], $_POST['item_id'])) {
  $inqId = $_POST['inq_id'];
  $itemId = $_POST['item_id'];
  $action = $_POST['action'] === 'approve' ? 'Approved' : 'Rejected';

  $stmt = $conn->prepare("UPDATE inquiries SET status = ? WHERE inq_id = ?");
  $stmt->bind_param("ss", $action, $inqId);

  if ($stmt->execute()) {
    header("Location: pages/inquiries.php");
    exit;
  } else {
    echo "Error updating record: " . $stmt->error;
  }
} else {
  echo "Invalid request. Required data missing.";
}
?>
