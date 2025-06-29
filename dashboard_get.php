<?php
  require 'connection.php';

  $sql = "SELECT *
        FROM items
        JOIN categories ON items.category_id = categories.category_id
        ORDER BY date_located DESC";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $projectBase = dirname($_SERVER['PHP_SELF']);

    while ($row = $result->fetch_assoc()) {

      $itemId = htmlspecialchars($row['item_id']);

      $relativeImagePath = htmlspecialchars($row['image_url']);
      $imagePath = '/lost_and_found' . '/' . $relativeImagePath;

      $itemName = htmlspecialchars($row['item_name']);
      $category = htmlspecialchars($row['category_name']);
      $location = htmlspecialchars($row['location']);
      $dateLocated = htmlspecialchars($row['date_located']);

      echo '
  <a href="inquiries_and_requests.php?item_id=' . urlencode($itemId) . '" class="card-link"
     style="cursor: pointer; color: inherit; text-decoration: none;">
    <div class="card">
      <img src="' . $imagePath . '" alt="' . $itemName . '" />
      <div class="card-content">
        <h4>' . getItemEmoji($category) . ' ' . $itemName . '</h4>
        <p>📂 ' . $category . '</p>
        <p>📍 ' . $location . '</p>
        <p>📅 ' . date("d/m/Y", strtotime($dateLocated)) . '</p>
      </div>
    </div>
  </a>';

    }
  } else {
    echo '<p>No items found.</p>';
  }

  // function to return an emoji based on category
  function getItemEmoji($category) {
    $map = [
      "Electronics" => "💻",
      "Stationery" => "🖊️",
      "Essentials" => "🚰",
    ];
    return $map[$category] ?? "📦";
  }
?>
