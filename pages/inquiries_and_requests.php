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

  <form action="../approval.php" method="POST">

  <main>
    <h2>Inquiry and Request</h2>
    <form action="../approval" method = "POST"></form>
    <div class="container">

          <!-- LEFT SIDE -->
    <div class="left">
        <img src="..\assets\images\Pencilpouch.png" alt="Pencil Pouch" class="item-img" />

        <label for="description"> Does this item belong to you? Make an inquiry? </label>
        <textarea
         id = "description"
         name="description" 
         required placeholder="Please provide a brief description of your item. Our team will look into it and get back to you as soon as possible.">
        </textarea>

        <div class="buttons">
          <button type="reset" class="Cancel">Cancel</button>
          <button type="submit" class="Submit">Submit</button>
        </div>
      </div>

      <!-- RIGHT SIDE -->
    <div class="right">
      <label for="item_name"><strong>Item Name:</strong></label>
      <input type="text" id="item_name" name="item_name" required placeholder="Eg: Pencil Pouch" />
      <br>
      <label for="category"><strong>Category</strong></label>
      <select id="category" name="category" required>
        <option value="" disabled selected>Select a category</option>
        <option value="accessories">Accessories</option>
        <option value="electronics">Electronics</option>
        <option value="clothing">Clothing</option>
        <option value="books">Books</option>
        <option value="other">Other</option>
      </select>
      <br>
      <label for="location"><strong>Location</strong></label>
      <input type="text" id="location" name="location" required placeholder="Eg: STMB 1st floor" />
      <br>
      <label for="date_time"><strong>Date/Time Retrieved</strong></label>
      <input type="datetime-local" id="date_time" name="date_time" required />
      <br>
      <label for="further_description"><strong>Further Description (optional)</strong></label>
      <textarea 
      id="further_description" 
      name="further_description"
      placeholder="Please provide any additional details that may help us identify your item.">
      </textarea>
      <!-- <div class="right">
        <p><strong>Item name:</strong> <br>Pencil pouch</p>
        <p><strong>Category:</strong> <br>Accessories</p>
        <p><strong>Location:</strong> <br>STMB 1st floor</p>
        <p><strong>Date/time retrieved</strong><br>12/04/2025, 11:05:00</p>
        <p><strong>Further description (optional)</strong><br>This item was retrieved after a 10 am class, phase 1.</p>
      </div> -->
      </div>
    </div>
  </main>
  </form>
</body>
</html>




