<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Inquiries - Lost and Found</title>
  <link rel="stylesheet" href="../assets/css/inquiries.css">
  <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet" />
</head>
<body>

  <!-- Navbar here -->
  <?php include '../includes/navbar.php' ?>

  <div class="title">Inquiries</div>
  <div class="filters">
    <span><img src="../assets/images/folder.png" style="width: 15px;"/> All</span>
    <span><img src="../assets/images/folder.png" style="width: 15px;"/> Pending</span>
    <span><img src="../assets/images/folder.png" style="width: 15px;"/> Resolved</span>
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
