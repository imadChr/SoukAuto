<!DOCTYPE html>
<html lang="en">
<?php
require_once 'utility/db_connection.php'; ?>

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
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <!-- style css -->
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen" />
</head>
<!-- body -->

<body class="main-layout">
  <!-- loader  -->
  <div class="loader_bg">
    <div class="loader"><img src="images/loading.gif" alt="#" /></div>
  </div>
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
                  <a href="index.html">
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
                  <li class="nav-item active">
                    <a class="nav-link" href="index.html">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="Pages\postform.php">Sell</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="">Rent</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="Pages\login.html">Login</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="Pages/signup.html">Sign up</a>
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
  <!-- banner -->
  <section class="banner_main">
    <div id="banner1" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#banner1" data-slide-to="0" class="active"></li>
        <li data-target="#banner1" data-slide-to="1"></li>
        <li data-target="#banner1" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="container-fluid">
            <div class="carousel-caption">
              <div class="row">
                <div class="col-md-6">
                  <div class="text-bg">
                    <h1>Welcome to SoukAuto</h1>
                    <span>"You need Auto! there is SoukAuto!"</span>
                    <p>
                      Your platform for buying and selling and renting cars
                    </p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="text_img">
                    <figure>
                      <img src="images/mazda.png" alt="#" />
                    </figure>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end banner -->
  <!-- search form -->
  <form action="" class="search">
    <ion-icon name="search-sharp" class="search-logo"></ion-icon>
    <input type="text" class="search-filter" placeholder="Search" />
  </form>
  <!-- end search form -->
  <!-- wedo  section -->
  <div class="wedo">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="titlepage">
            <p>Explore more</p>
            <a href="">
              <ion-icon class="arrow1" name="chevron-down-outline"></ion-icon>
              <ion-icon class="arrow2" name="chevron-down-outline"></ion-icon>
            </a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-10 offset-md-1">
          <div class="row">
            <?php
            $sql = "SELECT id, title, price, image_url FROM car_selling_posts";
            $result = mysqli_query($conn, $sql);
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
            ?>
                <div class="col-md-6 margin_bottom">
                  <div class="work">
                    <figure><img src="<?php echo $row['image_url']; ?>" alt="#" /></figure>
                  </div>
                  <div class="work_text">
                    <a href="Pages/post.php?id=<?php echo $row['id']; ?>">
                      <h3><?php echo $row['title']; ?><br /><span class="blu"><?php echo $row['price']; ?></span></h3>
                    </a>
                  </div>
                </div>
            <?php
              }
            } else {
              echo "0 results";
            }
            $conn->close();
            ?>
          </div>
        </div>
      </div>

      <a class="read_more" href="#">See More</a>
    </div>
  </div>
  </div>
  </div>
  <!-- end wedo  section -->

  <!--  footer -->
  <footer id="contact">
    <div class="aboutus" id="abouts">
      <p>About us</p>
      <div>
        <i><ion-icon name="mail"></ion-icon></i>
        <a href="">Email</a>
      </div>
      <div>
        <i><ion-icon name="logo-facebook"></ion-icon></i>
        <a href="">Facebook</a>
      </div>
      <div>
        <i><ion-icon name="logo-instagram"></ion-icon></i>
        <a href="">Instagram</a>
      </div>
      <div>
        <i><ion-icon name="logo-linkedin"></ion-icon></i>
        <a href="">LinkedIn</a>
      </div>
    </div>
  </footer>
  <!-- end footer -->
  <!-- Javascript files-->
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/jquery-3.0.0.min.js"></script>
  <!-- sidebar -->
  <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
  <script src="js/custom.js"></script>
  <!-- icons -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>