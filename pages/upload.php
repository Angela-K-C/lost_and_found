<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Form</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/upload.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navbar goes here -->

    <div class="upload-container">
        <h1>Posts upload</h1>

        <form action="" method="post" class="upload-form">

            <div class="main-panel">
                <!-- File Upload Area -->
                <div class="upload-area">
                    <label for="profilePic">
                        <img src="../assets/images/add_photo.png" />
                        <p>Upload your cover picture here</p>
                        <p><small>File formats: PDF, JPG or PNG</small></p>
                        <small>Max 5MB</small>

                        <input type="file" name="profilePic" id="profilePic">
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
                        <input
                        class="labels"
                        type="text"
                        id="category"
                        name="category"
                        placeholder="Accessories"
                        required
                        />
                    </label>

                    <label for="name">
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
                <button type="button" class="cancel">Cancel</button>
                <button type="submit" class="submit">Upload</button>
            </div>
        </form>
    </div>
</body>
</html>