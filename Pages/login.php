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
  <link rel="stylesheet" href="../css/login.css" />
  <title>Log in</title>
</head>

<body>
  <header>
    <a href="../index.php">
      <div class="logo">
        <img src="../images/logo.png">
      </div>
    </a>
    <p class="Loggin">Logging in...</p>
  </header>

  <section class="main">
    <h1>Welcome to SoukAuto!</h1>
    <h2>Your Platform for Buying (Selling) & Renting cars in Algeria.</h2>
    <h3>Log in now to post your car !</h3>
    <?php
    if (isset($_SESSION['message'])) {
      echo '<h5 style="color:red;">' . $_SESSION['message'] . '</h5>';
      unset($_SESSION['message']);
      unset($_SESSION['message_type']);
    }
    ?>
    <div class="info">
      <form method="POST" action="../utility/user_login.php">
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
    <br />
    <a href="signup.php">Create account</a>
  </section>
</body>

</html>