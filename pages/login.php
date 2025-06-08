<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <title>Registration Form</title>
  </head>
  <body>
    <div class="container">
      <section class="image-panel">
        <img src="../assets/images/heroimage.png" alt="hero section image" />
      </section>

      <form action="/submit" method="post" class="form-panel">
        <img
          src="../assets/images/smallerimage.png"
          alt="smaller image"
          width="100"
          height="100"
          class="logo-image"
        />

        <fieldset>

          <label for="username">
            Username
            <input
              class="labels icon-input"
              type="text"
              id="username"
              name="username"
              placeholder="12345"
              required
            />
          </label>

          <label for="password">
            Password
            <input
              class="labels icon-input"
              type="password"
              id="password"
              name="password"
              placeholder="Enter your password"
              required
            />
          </label>

          <input type="submit" value="Login" class="submit" />
          <p>
            Don't have an account?
            <a href="../index.php">Sign up</a>
          </p>
        </fieldset>
              </fieldset>
      </form>
    </div>
  </body>
</html>