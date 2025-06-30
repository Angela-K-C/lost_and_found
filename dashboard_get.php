<?php
  require 'connection.php';

  // Get search value if set
  $search = isset($_GET['search']) ? trim($_GET['search']) : '';
  $location = isset($_GET['location']) ? trim($_GET['location']) : '';
  $date = isset($_GET['date']) ? trim($_GET['date']) : '';
  $category = isset($_GET['category']) ? trim($_GET['category']) : '';

  $search = $conn->real_escape_string($search);
  $location = $conn->real_escape_string($location);
  $date = $conn->real_escape_string($date);
  $category = $conn->real_escape_string($category);

  // Dynamic WHERE clause
  $where = [];

  if ($search !== '') {
    $where[] = "(item_name LIKE '%$search%' OR category_name LIKE '%$search%')";
  }

  if ($location !== '') {
    $where[] = "location = '$location'";
  }

  if ($date !== '') {
    $where[] = "date_located = '$date'";
  }

  if ($category !== '') {
    $where[] = "items.category_id = '$category'";
  }

  $whereClause = count($where) ? "WHERE " . implode(" AND ", $where) : '';

  $sql = "SELECT *
      FROM items
      JOIN categories ON items.category_id = categories.category_id
      $whereClause
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
