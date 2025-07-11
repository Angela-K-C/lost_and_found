<?php
require '../connection.php';

$search = $_GET['search'] ?? '';

if (!empty($search)) {
    $stmt = $conn->prepare("SELECT users.*, roles.role_name AS role_name FROM users 
                            LEFT JOIN roles ON users.role = roles.role_id 
                            WHERE users.username LIKE ? OR users.email LIKE ?");
    $searchTerm = "%" . $search . "%";
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
} else {
    $stmt = $conn->prepare("SELECT users.*, roles.role_name AS role_name FROM users 
                            LEFT JOIN roles ON users.role = roles.role_id");
}

$stmt->execute();
$result = $stmt->get_result();
?>
