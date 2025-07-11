<?php session_start() ?>

<?php 
  // Redirect to dashboard page if user is not admin
  if ($_SESSION['role_name'] !== 'Admin') {
    header("Location: ./dashboard.php");
    exit;
  }
?>

<!-- inquiries_results.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>LI-FI Inquiries</title>
  <link rel="stylesheet" href="../assets/css/dashboard.css" />
  <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet" />
  <!-- Flatpickr CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
</head>
<body>
  <?php include '../includes/navbar.php' ?>

  <div class="inquiries-page">

    <form action="" method='POST' id="filters">
      <!-- Filter section -->
      <section class="item-controls">
        <div class="search-upload">
          <div class="search-group">
            <button class="filter-icon">
              <img src="../assets/images/filter.png" alt="filter" />
            </button>

            <input type="text" name="search" placeholder="Search for inquiries" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" />

          </div>
        </div>

        <div class="filter-options">
          <!-- Date filter -->
          <input
              type="text"
              id="datePicker"
              name="date"
              placeholder="Date"
              value="<?= htmlspecialchars($_GET['date'] ?? '') ?>"
              autocomplete="off"
          />

          <!-- Category filter -->
          <select name="category" id="categoryFilter">

              <option value="">Select Category</option>

              <?php 
                require '../connection.php';

                $selected = $_GET['category'] ?? '';

                $sql = "SELECT * FROM categories";
                $result = $conn->query($sql);

                if ($result->num_rows > 0 ) {
                  while ($row = $result->fetch_assoc()) {
                    $category_id = $row['category_id'];
                    $category_name = $row['category_name'];

                    $isSelected = $selected == $category_id ? 'selected' : '';
                    echo "<option value= '" . htmlspecialchars($category_id) . "' $isSelected>" . htmlspecialchars($category_name) . "</option>";
                  }
                }
              ?>
          </select>

          <input type="text" placeholder="Location" name="location" value="<?= htmlspecialchars($_GET['location'] ?? '') ?>" id="locationFilter" />

          <select name="status" id="statusFilter">
            <option value="">Select status</option>
            <option value="approved">Approved</option>
            <option value="rejected">Rejected</option>
          </select>

          <button type="submit" class="filter-button">Apply filters</button>
          <button type="button" onclick="resetFilters()" class="reset-button">Reset Filters</button>
        </div>
      </section>
    </form>

    <!-- Inquiries display grid -->
    <main class="item-grid">
      <?php include '../inquiries_get.php'; ?>
    </main>
  </div>
  
  <script>
    const form = filters.closest("form");

    // Reset filters
    const resetFilters = () => {
      console.log("Resetting filters...");
      const datePicker = document.getElementById("datePicker");
      const locationFilter = document.getElementById("locationFilter");
      const categoryFilter = document.getElementById("categoryFilter");
      const statusFilter = document.getElementById("statusFilter");

      locationFilter.value = "";
      datePicker.value = "";
      categoryFilter.value = "";
      statusFilter.value = "";

      form.submit();
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    
  <script>
    // Initialize flatpickr
    flatpickr("#datePicker", {
      dateFormat: "Y-m-d", // Matches SQL DATE format
      allowInput: true
    });
  </script>
</body>
</html>
