<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Include necessary CSS files -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/all_posts.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/notyf/notyf.min.css" />

  <!-- Include necessary JavaScript files -->
  <script src="assets/js/posts.js"></script>
  <script src="assets/js/sell.js"></script>

  <!-- External libraries -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <!-- Icon libraries -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- Include Ionicons -->
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

  <!-- Include jQuery and related libraries -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  <!-- Include custom CSS file -->
  <link rel="stylesheet" href="assets/css/header.css">
</head>
<style>
  .btn:hover {
    background-color:#ED6C15 !important;
    color: white !important;
  }
  .btn:hover ion-icon{
    color: white !important;
  }
  ion-icon{
    color: #ED6C15 !important;
  }
</style>
<body>
  <!-- Header section -->
  <header>
    <div class="container" style="padding-top:1rem; display: flex; justify-content: space-between; align-items: center;font-size: 50px; color: #ED6C15;">
      <!-- Brand logo -->
      <a class="navbar-brand" href="index.php">
        <a class="btn" href="index.php">
          <ion-icon name="arrow-back-circle" ></ion-icon>
          home
        </a>
      </a>
      <a class="navbar-brand" href="index.php?action=rent">
        <a class="btn" href="index.php?action=rent">
          Post for Rent?
          <ion-icon name="arrow-forward-circle" ></ion-icon>
        </a>
      </a>
    </div>
  </header>
