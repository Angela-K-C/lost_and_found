<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>LI-FI Dashboard</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    
    <?php include '../includes/navbar.php' ?>

    <div class="dashboard-page">
      <section class="search-filter">
        <div class="upper-search-section">
          <div class="search-bar">
            <img src="../assets/images/filter.png" alt="filter" class="filter-btn">

            <input type="text" placeholder="Search for items" />
          </div>

          <button class="submit" onclick="redirectToUpload()">Upload an item</button>
        </div>

        <div class="filters">
          <select>
            <option>Date</option>
          </select>
          <select>
            <option>Category</option>
          </select>
          <select>
            <option>Location</option>
          </select>
        </div>

        
      </section>

      <main class="card-grid">
      <?php include 'dashboard_get.php'; ?>
        
    </main>

    <script>
      const redirectToUpload = () => {
        window.location.href = '../pages/upload.php';
      }
    </script>
  </body>
</html>
