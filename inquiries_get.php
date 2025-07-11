<?php
session_start();
require_once 'connection.php';

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role_name'];

// Get filter values
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$location = isset($_GET['location']) ? trim($_GET['location']) : '';
$date = isset($_GET['date']) ? trim($_GET['date']) : '';
$category = isset($_GET['category']) ? trim($_GET['category']) : '';
$status = isset($_GET['status']) ? trim($_GET['status']) : '';

$where = [];
$params = [];
$types = "";

// Only show user's inquiries if not admin
if ($role !== 'Admin') {
    $where[] = "inquiries.user_id = ?";
    $params[] = $user_id;
    $types .= "i";
}

// Filters
if ($search !== '') {
    $where[] = "(items.item_name LIKE ? OR categories.category_name LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $types .= "ss";
}
if ($location !== '') {
    $where[] = "items.location LIKE ?";
    $params[] = "%$location%";
    $types .= "s";
}
if ($date !== '') {
    $where[] = "items.date_located = ?";
    $params[] = $date;
    $types .= "s";
}
if ($category !== '') {
    $where[] = "items.category_id = ?";
    $params[] = $category;
    $types .= "i";
}
if ($status !== '') {
    $where[] = "inquiries.status = ?";
    $params[] = $status;
    $types .= "s";
}

$whereClause = count($where) ? "WHERE " . implode(" AND ", $where) : "";

$sql = "SELECT inquiries.*, items.item_name, items.image_url, items.location, items.date_located, 
               categories.category_name
        FROM inquiries
        JOIN items ON inquiries.item_id = items.item_id
        JOIN categories ON items.category_id = categories.category_id
        $whereClause
        ORDER BY inquiries.inq_date DESC";

$stmt = $conn->prepare($sql);
if ($params) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $itemId = htmlspecialchars($row['item_id']);
        $imagePath = '/lost_and_found/' . htmlspecialchars($row['image_url']);
        $itemName = htmlspecialchars($row['item_name']);
        $category = htmlspecialchars($row['category_name']);
        $location = htmlspecialchars($row['location']);
        $dateLocated = htmlspecialchars($row['date_located']);
        $status = htmlspecialchars($row['status']);
        $inquiryId = (int)$row['inquiry_id'];
        $ownerId = (int)$row['user_id'];

        // Badge color
        $badgeColors = [
            'approved' => ['bg' => '#fff', 'text' => '#4caf50'],
            'pending' => ['bg' => '#fff', 'text' => '#ff9800'],
            'rejected' => ['bg' => '#fff', 'text' => '#f44336']
        ];
        $badge = $badgeColors[strtolower($status)] ?? ['bg' => '#fff', 'text' => '#9e9e9e'];

        echo '
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
                </span><br>';
        // Show edit button if admin or owner
        if ($role === 'Admin' || $ownerId === $user_id) {
            echo '<a href="pages/edit_inquiry.php?id=' . $inquiryId . '" class="edit-btn">Edit</a>';
        }
        echo '
            </div>
        </div>';
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