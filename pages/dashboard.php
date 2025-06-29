<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>LI-FI Dashboard</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css" />
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet" />
  </head>
  <body>
    <?php include '../includes/navbar.php' ?>

    <div class="dashboard-page">
      <!-- Item search & filter section -->
      <section class="item-controls">
        <div class="search-upload">
          <div class="search-group">
            <button class="filter-icon">
              <img src="../assets/images/filter.png" alt="filter" />
            </button>
            <input type="text" placeholder="Search for items" />
          </div>
          <button class="upload-button" onclick="redirectToUpload()">Upload an item</button>
        </div>

        <div class="filter-options">
          <select><option>Date</option></select>
          <select><option>Category</option></select>
          <select><option>Location</option></select>
        </div>
      </section>

      <!-- Item display grid -->
      <main class="item-grid">
        <?php include '../dashboard_get.php'; ?>
      </main>
    </div>

    <script>
      const redirectToUpload = () => {
        window.location.href = '../pages/upload.php';
      }
    </script>
  </body>
</html>
