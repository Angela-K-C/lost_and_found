<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/profile.css">
        <title>Profile Page</title>
    </head>

    <body>
        
        <?php include '../includes/navbar.php' ?>

        <h1>Profile Settings</h1>
        
        <div class="container">
            <div class="image-container">
                <p class="section-title">Profile</p>

                <div class="upload-area">
                    <label for="profilePic">
                        <img src="../assets/images/add_photo.png" />
                        <p>Upload your cover picture here</p>
                        <p><small>File formats: PDF, JPG or PNG</small></p>
                        <small>Max 5MB</small>

                        <input type="file" name="profilePic" id="profilePic">
                    </label>
                </div>

                <div class="icon-with-text">
                    <img src="../assets/images/editing icon.png" width="15" height="15">
                    <span class="icon-text">Edit Profile Picture</span>
                </div>

                <input class="yah" type="submit" value="Log Out">
        
            </div>

            <div class="form-container">
                <p class="section-title">Personal details</p>

                <label for="iud">ID</label>
                <input type="text" id="uid" class="lbl" name="uid" placeholder="123456" required>

                <label for="uname">Username</label>
                <input type="text" id="uname" name="uname" class="lbl" placeholder="John Doe" required>

                <label for="email">Email</label>
                <input type="text" id="email" name="email" class="lbl" placeholder="you@example.com" required>

                <label for="pword">Password</label>
                <input type="password" id="pword" name="pword" class="lbl" placeholder="************" required>
            
                <div id="submit-container">
                    <input class="yoh" type="submit" value="Cancel">
                    <input class="yah" type="submit" value="Save Changes">
                </div>
            </div>
        </div>

    </body>
</html>