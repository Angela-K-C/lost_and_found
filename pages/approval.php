<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Approval Request</title>
  <link rel="stylesheet" href="../assets/css/approval.css" />
</head>
<body>
  <?php include '../includes/navbar.php' ?>

  <main>
    <h2>Approval Request</h2>
    <div class="container">
      <div class="left">
        <img src="../assets/images/Pencilpouch.png" alt="Pencil Pouch" class="item-img" />
        <label>Description</label>
        <textarea readonly>
It is a small white pouch with two red pens inside. I think I left it in STMB F204 after my philosophy class.
        </textarea>
        <div class="buttons">
          <button class="approve">Approve</button>
          <button class="reject">Reject</button>
        </div>
      </div>
      <div class="right">
        <p><strong>Student ID</strong><br>12345</p>
        <p><strong>Item name:</strong> <br>Pencil pouch</p>
        <p><strong>Category:</strong> <br>Accessories</p>
        <p><strong>Location:</strong> <br>STMB 1st floor</p>
        <p><strong>Date/time retrieved</strong><br>12/04/2025, 11:05:00</p>
        <p><strong>Date/time requested</strong><br>12/04/2025, 11:05:00</p>
        <p><strong>Further description (optional)</strong><br>This item was retrieved after a 10 am class, phase 1.</p>
      </div>
    </div>
  </main>
</body>
</html>
