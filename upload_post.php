<?php
    require "connection.php";

    // Get POST information from submitted data in the form
    $post_details = $_POST;

    $item_id = uniqid();
    $admin_id = 1; // To be changed depending on login
    $item_name = $post_details["name"];
    $item_description = $post_details["description"];
    $category_id = $post_details["category"];
    $location = $post_details["location"];
    $date_located = date("Y-m-d"); // Get current date
    $status = "pending";

    // Item pic
    $file = $_FILES['imageUrl'];

    $tmpName = $file['tmp_name'];
    $fileName = time() . "_" . basename($file['name']);
    $fileSize = $file['size'];
    $uploadDir = "uploads/";
    $uploadPath = $uploadDir . $fileName;

    // Check file size (max 5MB)
    if ($fileSize > 5 * 1024 * 1024) {
        echo "File is too large. Maximum allowed size is 5MB.";
        exit;
    }

    // Save the file
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Create folder if not exists
    }

    if (move_uploaded_file($tmpName, $uploadPath)) {
        // Insert into DB
        $stmt = $conn->prepare("INSERT INTO items (item_id, admin_id, item_name, item_description, category_id," .
        "location, date_located, image_url, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("sssssssss",
            $item_id, $admin_id, $item_name, $item_description, $category_id, $location, $date_located, $uploadPath, $status
        );

        if ($stmt->execute()) {
            echo "<script>alert('Item uploaded successfully!'); window.location.href='./pages/dashboard.php'</script>";
            exit;
        } else {
            echo "<script>alert('Database error: " . $stmt->error . "')</script>Database error: ";
            exit;
        }
    } else {
        echo "<script>Failed to upload image.</script>";
        exit;
    }

?>

<!-- 
item_id
admin_id
item_name
item_description
category_id
location
date_located
image_url
status
-->