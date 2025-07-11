<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./assets/css/style.css" />
   
  </head>
  <body>
      <div class="container">
        <section class="image-panel">
          <img src="./assets/images/heroimage.png" alt="hero section image" />
        </section>

         <form action="./pages/register.php" method="post" class="form-panel">
          <img
            src="./assets/images/smallerimage.png"
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
                placeholder="Enter your username"
                required
              />
            </label>

            <label for="email">
              Email
              <input
                class="labels icon-input"
                type="email"
                id="email"
                name="email"
                placeholder="you@example.com"
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
                placeholder="Create a password"
                required
              />
            </label>

            <label for="confirm-password">
              Confirm Password
              <input
                class="labels icon-input"
                type="password"
                id="confirm-password"
                name="confirm-password"
                placeholder="Re-enter your password"
                required
              />
            </label>

            <input type="submit" value="Sign up" class="submit" />
            <p>
              Already have an account?
              <a href="./pages/login.php">Login</a>
            </p>
          </fieldset>
                </fieldset>
        </form>
      </div>
  </body>
</html>