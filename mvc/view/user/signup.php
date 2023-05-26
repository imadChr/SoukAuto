<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="assets/css/signup.css" />
  <title>Sign up</title>
</head>

<body>
  <header>
    <div class="logo">
      <a href="../index.php">
        <img src="../images/logo.png">
      </a>
    </div>
    <p class="Loggin">Signing up...</p>
  </header>

  <section class="main">
    <h1>Please create your account</h1>
    <?php
    if (isset($_SESSION['error_message'])) {
      echo '<h5 style="color:red;">' . $_SESSION['error_message'] . '</h5>';
      unset($_SESSION['error_message']);
    }
    ?>
    <div class="info">
      <form method="POST" action="index.php?action=do_signup">
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
          <input type="tel" name="phonenumber" id="PhoneNumber" required />
        </div>
        <div>
          <label for="wilaya">Wilaya:</label>
          <select id="wilaya" name="wilaya">
            <option value="">Select a wilaya</option>
            <option value="Adrar">Adrar</option>
            <option value="Chlef">Chlef</option>
            <option value="Laghouat">Laghouat</option>
            <option value="Oum El Bouaghi">Oum El Bouaghi</option>
            <option value="Batna">Batna</option>
            <option value="Béjaïa">Béjaïa</option>
            <option value="Biskra">Biskra</option>
            <option value="Béchar">Béchar</option>
            <option value="Blida">Blida</option>
            <option value="Bouira">Bouira</option>
            <option value="Tamanrasset">Tamanrasset</option>
            <option value="Tébessa">Tébessa</option>
            <option value="Tlemcen">Tlemcen</option>
            <option value="Tiaret">Tiaret</option>
            <option value="Tizi Ouzou">Tizi Ouzou</option>
            <option value="Algiers">Algiers</option>
            <option value="Djelfa">Djelfa</option>
            <option value="Jijel">Jijel</option>
            <option value="Sétif">Sétif</option>
            <option value="Saïda">Saïda</option>
            <option value="Skikda">Skikda</option>
            <option value="Sidi Bel Abbès">Sidi Bel Abbès</option>
            <option value="Annaba">Annaba</option>
            <option value="Guelma">Guelma</option>
            <option value="Constantine">Constantine</option>
            <option value="Médéa">Médéa</option>
            <option value="Mostaganem">Mostaganem</option>
            <option value="M'Sila">M'Sila</option>
            <option value="Mascara">Mascara</option>
            <option value="Ouargla">Ouargla</option>
            <option value="Oran">Oran</option>
            <option value="El Bayadh">El Bayadh</option>
            <option value="Illizi">Illizi</option>
            <option value="Bordj Bou Arreridj">Bordj Bou Arreridj</option>
            <option value="Boumerdès">Boumerdès</option>
            <option value="El Tarf">El Tarf</option>
            <option value="Tindouf">Tindouf</option>
            <option value="Tissemsilt">Tissemsilt</option>
            <option value="El Oued">El Oued</option>
            <option value="Khenchela">Khenchela</option>
            <option value="Souk Ahras">Souk Ahras</option>
            <option value="Tipaza">Tipaza</option>
            <option value="Mila">Mila</option>
            <option value="Aïn Defla">Aïn Defla</option>
            <option value="Naâma">Naâma</option>
            <option value="Aïn Témouchent">Aïn Témouchent</option>
            <option value="Ghardaïa">Ghardaïa</option>
            <option value="Relizane">Relizane</option>
          </select>
        </div>
        <div>
          <label for="terms">By clicking "Create account" You agree to SoukAuto TOS & Privacy Policy.</label>
          <input type="checkbox" class="check" name="terms" id="terms" required />
          <div>
            <input type="submit" class="sign" value="Create Account" />
          </div>
      </form>
    </div>
    <p>Already have an account ? <a href="index.php?action=login"> Log in ! </a></p>
  </section>
</body>

</html>