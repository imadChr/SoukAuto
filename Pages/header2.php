<?php
session_start();
require_once '../utility/db_connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- mobile metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="viewport" content="initial-scale=1, maximum-scale=1" />
 	<!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Iconbox -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <style>
    .navigation.navbar-dark .navbar-nav .nav-link:focus,
    .navigation.navbar-dark .navbar-nav .nav-link:hover {
      color: white ;
    }
    .navigation.navbar-dark .navbar-nav .nav-link,
    .navbar-scroll .navbar-toggler-icon,
    .navbar-scroll .navbar-brand , .btn{
      padding: 13 25px; 
      border: 2.5px solid #ED6C15; 
      border-radius: 13px; 
      font-size: 20px; 
      line-height: 20px; 
      font-weight: 600; 
      font-family: "Nasalization", sans-serif; 
      color: #1f1f1f !important;
    }

    .name {
      font-size: 20px; 
      font-weight: 600; 
      font-family: "Nasalization", sans-serif; 
      color: #1f1f1f !important;
    }

    .navbar-scroll {
      background-color: #FFC017;
    }

    /* Color of the links AFTER scroll */
    .navbar-scrolled .nav-link,
    .navbar-scrolled .navbar-toggler-icon,
    .navbar-scroll .navbar-brand {
      color: #262626;
    }

    /* Color of the navbar AFTER scroll */
    .navbar-scrolled {
      background-color: #fff;
    }

    .logo {
      height: 50px;
      margin-left: 10px;
      margin-bottom: auto;
    }
    .rounded-circle{
      height: 50px;
      margin-right: 10px;
    }
  </style>
</head>
<!-- body -->
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container inline">
      <a class="navbar-brand inline-item" href="../index.php">
        <img src="../images/logo.png" class="logo">
      </a>
      <button class="navbar-toggler inline-item" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto d-flex align-items-center">    
          <?php
            if (isset($_SESSION['user_id'])) {
              echo '
              <li class="nav-item mr-3">
                <div class="nav-link-wrapper">
                  <a class="nav-link btn" href="Pages\postform.php">Sell</a>
                </div>
              </li>
              <li class="nav-item mr-3">
                <div class="nav-link-wrapper">
                  <a class="nav-link btn" href="#">Rent</a>
                </div>
              </li>
              ';
              echo '
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="d-flex align-items-center">
                      <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(9).jpg" class="rounded-circle mr-2" height="30" alt="" loading="lazy">
                      <span class="text-truncate name">' . $_SESSION['firstname'] . '</span>
                    </div>
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li>
                  <a class="dropdown-item" href="#"><ion-icon name="person-circle-outline"></ion-icon> My profile</a>
                </li>
                <li>
                  <form method="post" action="all_posts.php">
                    <input type="hidden" name="action" value="myposts">
                    <a href="#" class="dropdown-item" onclick="event.preventDefault(); this.closest(\'form\').submit();"><ion-icon name="document-outline"></ion-icon> My posts</a>
                  </form>
                </li>
                <li>
                  <a class="dropdown-item" href="#"><ion-icon name="heart-outline"></ion-icon> My Favorites</a>
                </li>
                <li>
                  <a class="dropdown-item" href="../utility/logout.php"><ion-icon name="log-out-outline"></ion-icon> Logout</a>
                </li>
                  </ul>
                </li>
              ';
            } else {
              echo '
                  <li class="nav-item mr-3">
                    <div class="nav-link-wrapper">
                      <a class="nav-link btn" href="Pages\signup.php">Sign up</a>
                    </div>
                  </li><br>
              ';
              echo '
                <li class="nav-item mr-3">
                  <div class="nav-link-wrapper">
                    <a class="nav-link btn" href="Pages\login.php">Login</a>
                  </div>
                </li><br>
              ';
            }
          ?>
          </li>

        </ul>
      </div>
    </div>
  </nav>
</body>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Popper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</html>