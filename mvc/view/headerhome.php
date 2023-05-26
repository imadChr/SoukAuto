<!DOCTYPE html>
<html lang="en">


<head>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/style.css" />
  <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen" />
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/custom.js"></script>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/jquery-3.0.0.min.js"></script>
</head>


<body>
  <header>
    <div class="header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
            <div class="full">
              <div class="center-desk">
                <div class="logo">
                  <a href="index.php?action=home">
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
                  if (isset($_SESSION['user_id'])) { ?>
                    <li class="nav-item">
                      <a class="nav-link" href="postform.php">Sell</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="">Rent</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link dropdown-toggle" href="#" id="my-account-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <?php echo $_SESSION['firstname'] ?></a>
                      <ul class="dropdown-menu" aria-labelledby="my-account-menu">
                        <li class="nav-item"><a class="nav-link" href="#">My Profile</a></li>
                        <li class="nav-item">
                          <form method="post" action="all_posts.php">
                            <input type="hidden" name="action" value="myposts">
                            <button type="submit" class="nav-link">My posts</button>
                          </form>
                        </li>
                        <li class="nav-item">
                          <form method="post" action="Pages/all_posts.php">
                            <input type="hidden" name="action" value="favorite">
                            <button type="submit" class="nav-link">My Favorites</button>
                          </form>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="utility/logout.php">Logout</a></li>
                      </ul>
                    <?php } else { ?>
                    <li class="nav-item">
                      <a class="nav-link" href="postform.php">Sell</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="signup.php">Sign up</a>
                    </li><br>
                    <li class="nav-item">
                      <a class="nav-link" href="login.php">Login</a>
                    </li>
                  <?php
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
  <!-- end header -->