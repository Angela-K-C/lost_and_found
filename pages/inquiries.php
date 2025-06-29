<!-- inquiries_results.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>LI-FI Inquiries</title>
  <link rel="stylesheet" href="../assets/css/dashboard.css" />
  <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet" />
</head>
<body>
  <?php include '../includes/navbar.php' ?>

  <div class="inquiries-page">
    <!-- Filter section -->
    <section class="item-controls">
      <div class="search-upload">
        <div class="search-group">
          <button class="filter-icon">
            <img src="../assets/images/filter.png" alt="filter" />
          </button>
          <input type="text" placeholder="Search for inquiries" />
        </div>
      </div>

      <div class="filter-options">
        <select><option>Date</option></select>
        <select><option>Category</option></select>
        <select><option>Location</option></select>
        <select><option>Status</option></select>
      </div>
    </section>

    <!-- Inquiries display grid -->
    <main class="item-grid">
      <?php include '../inquiries_get.php'; ?>
    </main>
  </div>
</body>
</html>
