<!DOCTYPE html>
<html lang="en">

<head>
  <!-- basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- mobile metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="viewport" content="initial-scale=1, maximum-scale=1" />
  <!-- site metas -->
  <title>SoukAuto</title>
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <!-- bootstrap css -->
  <link rel="stylesheet" href="../css/bootstrap.min.css" />
  <!-- style css -->
  <link rel="stylesheet" href="../css/style.css" />
  <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen" />
</head>
<!-- body -->

<body class="main-layout">
  <!-- loader  -->
  <!-- end loader -->
  <!-- header -->
  <header>
    <!-- header inner -->
    <div class="header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
            <div class="full">
              <div class="center-desk">
                <div class="logo">
                  <a href="../index.php">
                    <p class="Souk">Souk</p>
                    <p class="Auto">Auto</p>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
            <nav class="navigation navbar navbar-expand-md navbar-dark">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarsExample04">
                <ul class="navbar-nav mr-auto">



                  <?php
                  if (isset($_SESSION['user_id'])) {
                    echo '<li class="nav-item">
                    <a class="nav-link" href="Pages\postform.php">Sell</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="">Rent</a>
                  </li>';
                    echo '  <li class="nav-item">
       <a class="nav-link dropdown-toggle" href="#" id="my-account-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . $_SESSION['firstname'] . '</a>
      <ul class="dropdown-menu" aria-labelledby="my-account-menu">
        <li class="nav-item"><a class="nav-link" href="#">My Profile</a></li>
        <li class="nav-item"><a class="nav-link" href="#">My posts</a></li>
        <li class="nav-item"><a class="nav-link" href="#">My favorites</a></li>
        <li class="nav-item"><a class="nav-link" href="utility/logout.php">Logout</a></li>
      </ul>
      </li>';
                  } else {
                    echo '<li class="nav-item">
      <a class="nav-link" href="..\Pages\signup.php">Sign up</a>
      </li><br>';
                    echo '<li class="nav-item">
      <a class="nav-link" href="..\Pages\login.php">Login</a>
      </li>';
                  }
                  ?>
                  </li>

                </ul>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- end header inner -->
  <!-- end header -->

</html>