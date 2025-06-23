<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Form</title>
    <link rel="stylesheet" href="../assets/css/upload.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navbar goes here -->
    <?php include '../includes/navbar.php' ?>

    <div class="upload-container">
        <h1>Posts upload</h1>

        <form action="../upload_post.php" method="post" class="upload-form" enctype="multipart/form-data">

            <div class="main-panel">
                <!-- File Upload Area -->
                <div class="upload-area">
                    <label for="imageUrl">
                        <img id="preview" src="../assets/images/add_photo.png" />
                        <p>Upload your cover picture here</p>
                        <p><small>File formats: PDF, JPG or PNG</small></p>
                        <small>Max 5MB</small>

                        <input type="file" name="imageUrl" id="imageUrl" accept="image/*" required onchange="previewImage(event)">
                    </label>
                </div>


                <!-- Form Labels -->
                <div class="form-labels">
                    <label for="name">
                        Item name:
                        <input
                        class="labels"
                        type="text"
                        id="name"
                        name="name"
                        placeholder="Pencil pouch"
                        required
                        />
                    </label>

                    <label for="category">
                        Category:
                        <select name="category" id="category" class="labels" required>
                            
                            <?php 
                                require '../connection.php';

                                $sql = "SELECT category_id, category_name from categories";

                                $result = $conn->query($sql);

                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['category_id'] . "'>" . $row['category_name'] . "</option>";
                                }
                            ?>

                        </select>
                    </label>

                    <label for="location">
                        Location:
                        <input
                        class="labels"
                        type="text"
                        id="location"
                        name="location"
                        placeholder="STMB 1st floor"
                        required
                        />
                    </label>

                    <label for="description">
                        Further description (optional)
                        <textarea 
                            class="labels"
                            name="description" 
                            id="description"
                            rows="5"
                            placeholder="You can choose not to add details here for sensitive items"
                            required
                            style="resize: none;"
                        ></textarea>
                    </label>
                </div>
            </div>

            <div class="buttons">
                <button type="button" class="cancel" onclick="cancel()">Cancel</button>
                <button type="submit" class="submit">Upload</button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const preview = document.getElementById('preview');
                preview.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        const cancel = () => {
            window.location.href = '../pages/dashboard.php';
        }
    </script>
</body>
</html>