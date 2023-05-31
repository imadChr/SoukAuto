<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/all_posts.css">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/notyf/notyf.min.css" />
  <script src="assets/js/posts.js"></script>
  <script src="assets/js/sell.js"></script>

  <!-- External libraries -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- Icon libraries -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- Ionicons -->
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <!-- jQuery and related libraries -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <!-- css file -->
  <link rel="stylesheet" href="assets/css/header.css">
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container inline">
        <a class="navbar-brand inline-item" href="index.php">
          <img src="assets/images/logo.png" class="logo">
        </a>
        <button class="navbar-toggler inline-item" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto d-flex align-items-center">
            <?php
            if ($appuser) { ?>
              <li class="nav-item mr-2">
                <div class="nav-link-wrapper">
                  <a class="nav-link btn" href="index.php?action=sell">Post for Sell</a>
                </div>
              </li>
              <li class="nav-item mr-3">
                <div class="nav-link-wrapper">
                  <a class="nav-link btn" href="index.php?action=rent">Post for Rent</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <div class="d-flex align-items-center">
                    <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(9).jpg" class="rounded-circle mr-2" height="30" alt="" loading="lazy">
                    <span class="text-truncate name"><?php echo $appuser['firstname']  ?></span>
                  </div>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <?php if ($appuser['firstname'] == 'admin') { ?>
                    <li>
                      <a class="dropdown-item" href="index.php?action=admin"><ion-icon name="person-circle-outline"></ion-icon> Dashboard</a>
                    </li>
                  <?php } ?>
                  <li>
                    <a href="index.php?action=list&see=myposts" class="dropdown-item"><ion-icon name="document-outline"></ion-icon> My posts</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="index.php?action=list?see=favourites"><ion-icon name="heart-outline"></ion-icon> My Favorites</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="index.php?action=logout"><ion-icon name="log-out-outline"></ion-icon> Logout</a>
                  </li>
                </ul>
              </li>
            <?php } else { ?>
              <li class="nav-item mr-3">
                <div class="nav-link-wrapper">
                  <a class="nav-link btn" href="index.php?action=signup">Sign up</a>
                </div>
              </li><br>
              <li class="nav-item mr-3">
                <div class="nav-link-wrapper">
                  <a class="nav-link btn" href="index.php?action=login">Login</a>
                </div>
              </li><br>
            <?php
            }
            ?>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>