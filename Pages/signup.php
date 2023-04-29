<?php session_start(); ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/signup.css" />
  <title>Sign up</title>
</head>

<body>
  <header>
    <div class="logo">
      <a href="../index.php">
        <p class="Souk">Souk</p>
        <p class="Auto">Auto</p>
      </a>
    </div>
    <p class="Loggin">Signing up...</p>
  </header>
  <section class="main">
    <h1>Please create your account</h1>
    <?php
    if (isset($_SESSION['message'])) {
      echo '<h5 style="color:red;">' . $_SESSION['message'] . '</h5>';
      unset($_SESSION['message']);
      unset($_SESSION['message_type']);
    }
    ?>

    <div class="info">
      <form method="POST" action="../utility/user_signup.php">
        <div>
          <label for="firstname">First Name:</label>
          <input type="text" name="firstname" id="firstname" required />
        </div>
        <div>
          <label for="lastname">Last Name:</label>
          <input type="text" name="lastname" id="lastname" required />
        </div>
        <div>
          <label for="email">Email:</label>
          <input type="email" name="email" id="email" required />
        </div>
        <div>
          <label for="password">Password:</label>
          <input type="password" name="password" id="password" required />
        </div>
        <div>
          <label for="PhoneNumber">Phone Number:</label>
          <input type="tel" name="PhoneNumber" id="PhoneNumber" required />
        </div>
        <p>
          By clicking "Create account" i agree to SoukAuto TOS & Privacy
          Policy.
        </p>
        <div>
          <input type="submit" class="sign" value="Signup" />
        </div>
      </form>
    </div>
  </section>
</body>

</html>