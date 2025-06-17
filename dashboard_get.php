<?php
include 'connection.php';

$sql = "SELECT * FROM uploads ORDER BY date_found DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $imagePath = htmlspecialchars($row['image_path']);
    $itemName = htmlspecialchars($row['item_name']);
    $category = htmlspecialchars($row['category']);
    $location = htmlspecialchars($row['location']);
    $dateFound = htmlspecialchars($row['date_found']);

    echo '
      <div class="card">
        <img src="' . $imagePath . '" alt="' . $itemName . '" />
        <div class="card-content">
          <h4>' . getItemEmoji($category) . ' ' . $itemName . '</h4>
          <p>📂 ' . $category . '</p>
          <p>📍 ' . $location . '</p>
          <p>📅 ' . date("d/m/Y", strtotime($dateFound)) . '</p>
        </div>
      </div>
    ';
  }
} else {
  echo '<p>No items found.</p>';
}

// Optional: function to return an emoji based on category
function getItemEmoji($category) {
  $map = [
    "Electronics" => "💻",
    "Stationery" => "🖊️",
    "Essentials" => "🚰"
  ];
  return $map[$category] ?? "📦";
}
?>
