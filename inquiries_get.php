<?php
require 'connection.php';

$sql = "SELECT inquiries.*, items.item_name, items.image_url, items.location, items.date_located, 
               categories.category_name
        FROM inquiries
        JOIN items ON inquiries.item_id = items.item_id
        JOIN categories ON items.category_id = categories.category_id
        ORDER BY inquiries.inq_date DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $itemId = htmlspecialchars($row['item_id']);
    $imagePath = '/lost_and_found/' . htmlspecialchars($row['image_url']);
    $itemName = htmlspecialchars($row['item_name']);
    $category = htmlspecialchars($row['category_name']);
    $location = htmlspecialchars($row['location']);
    $dateLocated = htmlspecialchars($row['date_located']);
    $status = htmlspecialchars($row['status']); // 'pending', 'approved', or 'rejected'

    // Dynamic badge style
    $badgeColors = [
      'approved' => ['bg' => '#fff', 'text' => '#4caf50'],
      'pending' => ['bg' => '#fff', 'text' => '#ff9800'],
      'rejected' => ['bg' => '#fff', 'text' => '#f44336']
    ];

    $badge = $badgeColors[strtolower($status)] ?? ['bg' => '#fff', 'text' => '#9e9e9e'];

    echo '
    <a href="admin_inquiries_and_requests.php?item_id=' . urlencode($itemId) . '" class="card-link" 
       style="cursor: pointer; color: inherit; text-decoration: none;">
      <div class="card">
        <img src="' . $imagePath . '" alt="' . $itemName . '" />
        <div class="card-content">
          <h4>' . getItemEmoji($category) . ' ' . $itemName . '</h4>
          <p>📂 ' . $category . '</p>
          <p>📍 ' . $location . '</p>
          <p>📅 ' . date("d/m/Y", strtotime($dateLocated)) . '</p>
          <span style="display: inline-block; margin-top: 0.5rem; padding: 4px 8px; 
                       border-radius: 12px; background: ' . $badge['bg'] . '; 
                       color: ' . $badge['text'] . '; font-size: 0.85rem;">
            ' . ucfirst($status) . '
          </span>
        </div>
      </div>
    </a>';
  }
} else {
  echo '<p>No inquiries found.</p>';
}

function getItemEmoji($category) {
  $map = [
    "Electronics" => "💻",
    "Stationery" => "🖊️",
    "Essentials" => "🚰",
    "Water bottles" => "💧"
  ];
  return $map[$category] ?? "📦";
}
?>
