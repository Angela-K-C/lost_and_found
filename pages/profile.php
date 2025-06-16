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
                 <section class="one">
            Profile
            </section><br>
            <img src="../assets/images/add-profile-picture-icon-1.png" width="200" height="200"><br>
        <div class="icon-with-text">
        <br><br><img src="../assets/images/editing icon.png" width="15" height="15"><br>
        <span class="icon-text">Edit Profile Picture</span>
        </div>
        <input class="yah" type="submit" value="Log Out">
        
        </div>
        <div class="form-container">
            <section class="two">
            Personal Details
            </section><br>
        <label for="iud">ID:</label><br>
        <input class="labels icon-input" type="text" id="uid" name="uid" placeholder="123456" required><br>
        <br><label for="uname">UserName:</label><br>
        <input class="labels icon-input" type="text" id="uname" name="uname" placeholder="John Doe" required><br>
        <br><label for="email">Email:</label><br>
        <input class="labels icon-input" type="text" id="email" name="email" placeholder="you@example.com" required><br>
        <br><label for="pword">Password:</label><br>
        <input class="labels icon-input" type="password" id="pword" name="pword" placeholder="************" required><br><br>
         <div id="submit-container">
        <br><br><input class="yoh" type="submit" value="Cancel">
        <input class="yah" type="submit" value="Save Changes">
        </div>
        </div>
        </div>

    </body>
</html>