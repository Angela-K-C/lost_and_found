<?php
require '../connection.php';

$itemData = null;
$inquiryData = null;

if (isset($_GET['item_id'])) {
  $itemId = ($_GET['item_id']);

  // Get item data
  $sqlItem = "SELECT items.*, categories.category_name 
              FROM items 
              JOIN categories ON items.category_id = categories.category_id
              WHERE item_id = '$itemId'";

  $resultItem = $conn->query($sqlItem);

  if ($resultItem && $resultItem->num_rows > 0) {
    $itemData = $resultItem->fetch_assoc();
  } else {
    echo "<p>Item not found.</p>";
    exit;
  }

  // Get latest inquiry for that item 
  $sqlInq = "SELECT * FROM inquiries WHERE item_id = '$itemId' ORDER BY inq_date DESC LIMIT 1";
  $resultInq = $conn->query($sqlInq);

  if ($resultInq && $resultInq->num_rows > 0) {
    $inquiryData = $resultInq->fetch_assoc();
  } else {
    echo "<p>No inquiry found for this item.</p>";
    exit;
  }

} else {
  echo "<p>No item ID provided.</p>";
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Review Inquiry</title>
  <link rel="stylesheet" href="../assets/css/admin_inquiries_and_requests.css?v=1.2" />
</head>
<body>

  <?php include '../includes/navbar.php'; ?>

  <main>
    <h2>Review Inquiry Request</h2>
    <div class="container">
      
      <!-- Left Side -->
      <div class="left">
        <img src="../<?php echo htmlspecialchars($itemData['image_url']); ?>" alt="Item Image" class="item-img" />

        <!-- Card: Inquiry submitted by user -->
        <div class="card purple-box">
          <p><strong>📄 Inquiry Submitted:</strong></p>
          <p><?php echo nl2br(htmlspecialchars($inquiryData['inq_description'])); ?></p>
        </div>

        <!-- Admin Action Form -->
        <form method="POST" action="../inquiry_decision.php">
          <input type="hidden" name="inq_id" value="<?php echo $inquiryData['inq_id']; ?>" />
          <input type="hidden" name="item_id" value="<?php echo $itemData['item_id']; ?>" />
          <div class="buttons">
            <button type="submit" name="action" value="reject" class="cancel-btn">Reject</button>
            <button type="submit" name="action" value="approve" class="submit-btn">Approve</button>
          </div>
        </form>
      </div>

      <!-- Right Side -->
      <div class="right">
        <p><strong>Item name:</strong><br><?php echo htmlspecialchars($itemData['item_name']); ?></p>
        <p><strong>Category:</strong><br><?php echo htmlspecialchars($itemData['category_name']); ?></p>
        <p><strong>Location:</strong><br><?php echo htmlspecialchars($itemData['location']); ?></p>
        <p><strong>Date/time retrieved:</strong><br><?php echo htmlspecialchars($itemData['date_located']); ?></p>
        <p><strong>Description:</strong><br><?php echo htmlspecialchars($itemData['item_description']); ?></p>

        <div class="card blue-box">
          <p><strong>💡 What happens next?</strong></p>
          <ul>
            <li>Review the user's inquiry description</li>
            <li>Approve if the description matches the item</li>
            <li>Reject if the details don’t match</li>
          </ul>
        </div>
      </div>
      
    </div>
  </main>
</body>
</html>
