<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Inquiries - Lost and Found</title>
  <link rel="stylesheet" href="Inquiries.css">
  <script src="https://kit.fontawesome.com/84bdbc0c50.js" crossorigin="anonymous"></script>
</head>
<body>
  <header>
    <div class="logo">
      <img src="assets\images\logo.png" alt="Logo" />
      <h1>Li-FI</h1>
    </div>

    <?php include '../includes/navbar.php'; ?>

    <!-- <nav>
      <a href="#">Dashboard</a>
      <a href="#">Inquiries</a>
      <a href="#">Notifications</a>
    </nav> -->
    <img src="assets\images\profilepic.png" alt="User" />
  </header>
  <div class="title">Inquiries</div>
  <div class="filters">
    <span>	<i class="fa-solid fa-folder" style="color: #5cb85c;"></i> All</span>
    <span>	<i class="fa-solid fa-hourglass-half" style="color: blueviolet;"></i> Pending</span>
    <span>	<i class="fa-solid fa-folder-open" style="color: #5cb85c;"></i> Resolved</span>
  </div>
  <div class="cards">
    <div class="card">
      <img src="https://images.pexels.com/photos/32463116/pexels-photo-32463116/free-photo-of-black-power-adapter-on-yellow-background.jpeg" alt="Laptop Charger" />
      <div class="card-body">
        <h3><i class="fa-solid fa-clipboard" style="color: #007bff;"></i> Laptop Charger</h3>
        <p><i class="fa-solid fa-tag" style="color: purple;"></i> Electronics</p>
        <p>	<i class="fa-solid fa-location-dot" style="color: red;"></i> STMB 1st floor</p>
        <p><i class="fa-solid fa-clock" style="color: lightblue;"></i> 12/04/2025</p>
        <div class="status pending">Pending</div>
      </div>
    </div>

    <div class="card">
      <img src="https://images.pexels.com/photos/32463116/pexels-photo-32463116/free-photo-of-black-power-adapter-on-yellow-background.jpeg" alt="Laptop Charger" />
      <div class="card-body">
        <h3><i class="fa-solid fa-clipboard" style="color: #007bff;"></i> Laptop Charger</h3>
        <p><i class="fa-solid fa-tag" style="color: purple;"></i> Electronics</p>
        <p><i class="fa-solid fa-location-dot" style="color: red;"></i> STMB 1st floor</p>
        <p><i class="fa-solid fa-clock" style="color: lightblue;"></i> 12/04/2025</p>
        <div class="status approved">Approved</div>
      </div>
    </div>

    <div class="card">
      <img src="https://images.pexels.com/photos/32463116/pexels-photo-32463116/free-photo-of-black-power-adapter-on-yellow-background.jpeg" alt="Laptop Charger" />
      <div class="card-body">
        <h3><i class="fa-solid fa-clipboard" style="color: #007bff;"></i> Laptop Charger</h3>
        <p><i class="fa-solid fa-tag" style="color: purple;"></i> Electronics</p>
        <p><i class="fa-solid fa-location-dot" style="color: red;"></i> STMB 1st floor</p>
        <p><i class="fa-solid fa-clock" style="color: lightblue;"></i> 12/04/2025</p>
        <div class="status rejected">Rejected</div>
      </div>
    </div>
  </div>
</body>
</html>
