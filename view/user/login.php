<?php
session_start();
if (isset($_GET['redirect_url'])) {
  $_SESSION['redirect_url'] = $_GET['redirect_url'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="assets/css/login.css" />
  <title>Log in</title>
</head>

<body>
  <!-- a button to go back home with icon -->
  <section class="main">
    <h1>Welcome to SoukAuto!</h1>
    <h2>Your Platform for Buying (Selling) & Renting cars in Algeria.</h2>
    <h3>Log in now to post your car !</h3>
    <?php
    if (isset($_SESSION['error_message'])) {
      echo '<h5 style="color:red;">' . $_SESSION['error_message'] . '</h5>';
      unset($_SESSION['error_message']);
    }
    ?>
    <div class="info">
      <form method="POST" action="index.php?action=do_login">
        <div>
          <label for="email">Email:</label>
          <input type="email" name="email" id="email" required />
        </div>
        <div>
          <label for="password">Password:</label>
          <input type="password" name="password" id="password" required />
        </div>
        <div>
          <input type="submit" class="log" value="Login" />
        </div>
      </form>
    </div>
    <p>If you don't have an account?</p>
    <a href="index.php?action=signup">Create account</a>
  </section>
</body>

</html>