<?php
require '../connection.php';

$itemData = null;

if (isset($_GET['item_id'])) {
  $itemId = ($_GET['item_id']);

  $sql = "SELECT items.*, categories.category_name 
          FROM items 
          JOIN categories ON items.category_id = categories.category_id
          WHERE item_id = '$itemId'";

  $result = $conn->query($sql);

  if ($result && $result->num_rows > 0) {
    $itemData = $result->fetch_assoc();
  } else {
    echo "<p>Item not found.</p>";
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
  <title>Inquiry and Request</title>
  <link rel="stylesheet" href="../assets/css/inquiries_and_requests.css?v=2" />
</head>
<body>

  <?php include '../includes/navbar.php'; ?>

  <main>
    <h2>Inquiry and Request</h2>
    <div class="container">
      
      <!-- Left Side -->
      <div class="left">
        <img src="../<?php echo htmlspecialchars($itemData['image_url']); ?>" alt="Item Image" class="item-img" />

        <!-- Does this item belong to you? -->
        <div class="card purple-box">
          <p><strong>📄 Does this item belong to you?</strong></p>
          <p>Please provide a detailed description to help us verify ownership.</p>
        </div>

        <form method="POST" action="../inquiries_and_requests_post.php">
          <input type="hidden" name="item_id" value="<?php echo $itemData['item_id']; ?>" />

          <label for="user_description"><strong>Describe Your Item *</strong></label>
          <textarea 
            name="user_description" 
            id="user_description" 
            placeholder="Please provide specific details about your item (color, brand, distinguishing features, where you lost it, etc.)"
            required
          ></textarea>

          <div class="buttons">
            <button type="reset" class="cancel-btn"> Reset</button>
            <button type="submit" class="submit-btn"> Submit Inquiry</button>
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
            <li>Your inquiry will be reviewed by our team</li>
            <li>If details match, you'll be contacted for verification</li>
            <li>Arrange pickup once ownership is confirmed</li>
          </ul>
        </div>
      </div>
      
    </div>
  </main>
</body>
</html>
