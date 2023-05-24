<?php 
session_start(); 
require_once 'utility/db_connection.php'; 
?> 

<!DOCTYPE html> 
<html lang="en"> 
<head> 
  <meta charset="utf-8" /> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge" /> 
  <meta name="viewport" content="width=device-width, initial-scale=1" /> 
  <title>SoukAuto</title> 
  <meta name="keywords" content="" /> 
  <meta name="description" content="" /> 
  <meta name="author" content="" /> 
  <link rel="stylesheet" href="css/bootstrap.min.css" /> 
  <link rel="stylesheet" href="css/style.css" /> 
  <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" /> 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen" /> 
</head> 

<body class="main-layout"> 
  <header> 
    <div class="header"> 
      <div class="container-fluid"> 
        <div class="row"> 
          <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section"> 
            <div class="full"> 
              <div class="center-desk"> 
                <div class="logo"> 
                  <a href="index.php"> 
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
                      <a class="nav-link" href="Pages\postform.php">Sell</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="">Rent</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link dropdown-toggle" href="#" id="my-account-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <?php echo $_SESSION['firstname'] ?></a>
                      <ul class="dropdown-menu" aria-labelledby="my-account-menu">
                        <li class="nav-item"><a class="nav-link" href="#">My Profile</a></li>
                        <li class="nav-item">
                          <form method="post" action="Pages/all_posts.php">
                            <input type="hidden" name="action" value="myposts">
                            <button type="submit" class="nav-link">My posts</button>
                          </form>
                        </li>
                        <li class="nav-item">
                          <form method="post" action="Pages/all_posts.php">
                            <input type="hidden" name="action" value="favorite">
                            <button type="submit" class="nav-link">
                              My Favorites
                            </button>
                          </form>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="utility/logout.php">Logout</a></li>
                      </ul>
                    <?php } else { ?>
                    <li class="nav-item">
                      <a class="nav-link" href="Pages\postform.php">Sell</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="Pages\signup.php">Sign up</a>
                    </li><br>
                    <li class="nav-item">
                      <a class="nav-link" href="Pages\login.php">Login</a>
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
                    <?php
                    if (isset($_SESSION['message'])) { ?>
                      <h5 style="color:red;"><?php echo $_SESSION['message'] ?></h5>;
                    <?php unset($_SESSION['message']);
                    } ?>
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
  <form method="post" action="pages/all_posts.php" class="search">
    <input type="hidden" name="action" value="search">
    <input type="text" name="keyword" placeholder="Search..." class="search-filter">
    <ion-icon name="search-sharp" class="search-logo"></ion-icon>
  </form>
  <!-- end banner -->

  <!-- wedo  section -->
  <div class="wedo">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="titlepage">
            <a href="#posts">
              <p>Explore</p>
              <ion-icon class="arrow1" name="chevron-down-outline"></ion-icon>
              <ion-icon class="arrow2" name="chevron-down-outline"></ion-icon>
            </a>
          </div>
        </div>
      </div>
      <div class="row" id="posts">
        <div class="col-md-10 offset-md-1">
          <div class="row">
            <?php
            $sql = "SELECT * FROM ( post join car on post.car_id = car.car_id ) join images on images.post_id = post.post_id where image_order = 1 order by post.post_id desc limit 4";
            $result = mysqli_query($conn, $sql);
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
            ?>
                <div class="col-md-6 margin_bottom">
                  <a href="Pages/post.php?id=<?php echo $row['post_id']; ?>">
                    <div class="work">
                      <figure><img src="<?php echo $row['url']; ?>" height="300" width="600" alt="#" /></figure>
                    </div>
                    <div class="work_text">
                      <h3><?php echo $row['title']; ?><br /><span class="blu"><?php echo $row['price']; ?></span></h3>
                    </div>
                  </a>
                </div>
            <?php
              }
            } else {
              echo "0 results";
            }
            ?>
          </div>
        </div>
      </div>

 <section class="about_section"> 
    <div class="container"> 
      <div class="row"> 
        <div class="col-md-12"> 
          <div class="full"> 
            <div class="heading_main text_align_center"> 
              <h2><span>About </span> Us</h2> 
            </div> 
          </div> 
        </div> 
      </div> 
      <div class="row"> 
        <div class="col-md-12"> 
          <div class="full"> 
            <p>SoukAuto is a marketplace where users can buy, sell, and rent cars. It was created to provide a platform for people to easily and safely buy, sell, and rent cars. We believe in making the car buying, selling, and renting experience as easy and stress-free as possible. </p> 
          </div> 
        </div> 
      </div> 
    </div> 
  </section> 

  <section class="why_choose_us layout_padding"> 
    <div class="container"> 
      <div class="row"> 
        <div class="col-md-12"> 
          <div class="full"> 
            <div class="heading_main text_align_center"> 
              <h2><span>Why </span>Choose Us</h2> 
            </div> 
          </div> 
        </div> 
      </div> 
      <div class="row"> 
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12"> 
          <div class="why_choose_us_item"> 
            <p>24/7 Support</p> 
            <h4>Online Support</h4> 
            <span class="icon"><i class="fa fa-phone"></i></span> 
          </div> 
        </div> 
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12"> 
          <div class="why_choose_us_item"> 
            <p>Fast and Secure</p> 
            <h4>Transactions</h4> 
            <span class="icon"><i class="fa fa-lock"></i></span> 
          </div> 
        </div> 
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12"> 
          <div class="why_choose_us_item"> 
            <p>Best Deals</p> 
            <h4>Offers and Discounts</h4> 
            <span class="icon"><i class="fa fa-tags"></i></span> 
          </div> 
        </div> 
      </div> 
    </div> 
  </section> 

  <section class="contact_section layout_padding"> 
    <div class="container"> 
      <div class="row"> 
        <div class="col-md-12"> 
          <div class="full"> 
            <div class="heading_main text_align_center"> 
              <h2><span>Contact </span>Us</h2> 
            </div> 
          </div> 
        </div> 
      </div> 
      <div class="row margin-top_30"> 
        <div class="col-lg-6 col-md-6 col-sm-12"> 
          <div class="full float-right_img"> 
            <img src="images/img10.png" alt="#"> 
          </div> 
        </div> 
        <div class="col-lg-6 col-md-6 col-sm-12"> 
          <div class="contact_form"> 
            <form method="post" 
              action="utility/contact_form.php"> 
              <?php if (isset($_SESSION['message'])) { ?> 
                <h5 style="color:red;"><?php echo $_SESSION['message'] ?></h5>; 
                <?php unset($_SESSION['message']); } ?> 
              <fieldset> 
                <div class="full field"> 
                  <input type="text" placeholder="Your Name" name="name" /> 
                </div> 
                <div class="full field"> 
                  <input type="email" placeholder="Email Address" name="email" /> 
                </div> 
                <div class="full field"> 
                  <input type="text" placeholder="Phone Number" name="phone" /> 
                </div> 
                <div class="full field"> 
                  <textarea placeholder="Message" name="message"></textarea> 
                </div> 
                <div class="full field btn_holder"> 
                  <button type="submit">Submit</button> 
                </div> 
              </fieldset> 
            </form> 
          </div> 
        </div> 
      </div> 
    </div> 
  </section> 

  <script src="js/jquery.min.js"></script> 
  <script src="js/popper.min.js"></script> 
  <script src="js/bootstrap.min.js"></script> 
  <script src="js/custom.js"></script> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script> 
</body> 

</html>