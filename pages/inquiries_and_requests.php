<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Inquiry and Request</title>
  <link rel="stylesheet" href="..\assets\css\inquries_and_requests.css" />
</head>
<body>
  
  <?php include '..\includes\navbar.php'; ?>

  <main>
    <h2>Inquiry and Request</h2>
    <div class="container">
      <div class="left">
        <img src="..\assets\images\Pencilpouch.png" alt="Pencil Pouch" class="item-img" />
        <label>Does this item belong to you? Make an inquiry?</label>
        <textarea readonly>
Please give a brief description of your item. Our team will look into it and get back to you as soon as possible.        </textarea>
        <div class="buttons">
          <button class="Cancel">Cancel</button>
          <button class="Submit">Submit</button>
        </div>
      </div>
      <div class="right">
        <p><strong>Item name:</strong> <br>Pencil pouch</p>
        <p><strong>Category:</strong> <br>Accessories</p>
        <p><strong>Location:</strong> <br>STMB 1st floor</p>
        <p><strong>Date/time retrieved</strong><br>12/04/2025, 11:05:00</p>
        <p><strong>Further description (optional)</strong><br>This item was retrieved after a 10 am class, phase 1.</p>
      </div>
    </div>
  </main>
</body>
</html>




