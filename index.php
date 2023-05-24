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
                  if (isset($_SESSION['user_id'])) {
                    echo '<li class="nav-item">
                            <a class="nav-link" href="Pages\postform.php">Sell</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="">Rent</a>
                          </li>';
                    echo ' <li class="nav-item">
                            <a class="nav-link dropdown-toggle" href="#" id="my-account-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . $_SESSION['firstname'] . '</a>

                            <ul class="dropdown-menu" aria-labelledby="my-account-menu">
                              <li class="nav-item"><a class="nav-link" href="#">My Profile</a></li>
                              <li class="nav-item">
                                <form method="post" action="Pages/all_posts.php">
                                  <input type="hidden" name="action" value="myposts">
                                  <button type="submit" class="nav-link"> My posts </button>
                                </form>
                              </li>
                              <li class="nav-item">
                                <form method="post" action="Pages/all_posts.php">
                                  <input type="hidden" name="action" value="favorites">
                                  <button type="submit" class="nav-link"> My Favorites </button>
                                </form>
                              </li>
                              <li class="nav-item"><a class="nav-link" href="utility/logout.php">Logout</a></li>
                            </ul> 
                          '; 
                  } else {
                    echo '<li class="nav-item"> 
                            <a class="nav-link" href="Pages\signup.php">Sign up</a> 
                          </li><br>'; 

                    echo '<li class="nav-item"> 
                            <a class="nav-link" href="Pages\login.php">Login</a> 
                          </li>'; 
                  } 
                  ?> 
                </ul>
              </div>
            </nav>
          </div>
        </div>
      </div> 
    </div> 
  </header> 

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
                    <?php if (isset($_SESSION['message'])) { ?> 
                      <h5 style="color:red;"><?php echo $_SESSION['message'] ?></h5>; 
                      <?php unset($_SESSION['message']); } ?> 
                    <h1>Welcome to SoukAuto</h1> 
                    <span>"You need Auto! there is SoukAuto"</span><br> 
                    <a href="Pages/all_posts.php">View All Posts</a> 
                  </div> 
                </div> 
              </div> 
            </div> 
          </div> 
        </div> 
      </div> 
    </div> 
  </section> 

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

  <footer> 
    <div class="footer"> 
      <div class="container"> 
        <div class="row"> 
          <div class="col-md-12"> 
            <div class="full"> 
              <div class="heading_main text_align_center white_fonts"> 
                <h2>Subscribe to our Newsletter</h2> 
              </div> 
            </div> 
          </div> 
        </div> 
        <div class="row"> 
          <div class="col-md-12"> 
            <div class="full"> 
              <div class="newsletter_form">
                <form method="post" action="utility/newsletter.php">
                  <?php if (isset($_SESSION['message'])) { ?> 
                    <h5 style="color:red;"><?php echo $_SESSION['message'] ?></h5>; 
                    <?php unset($_SESSION['message']); } ?> 
                  <input type="email" placeholder="Your Email" name="email" /> 
                  <button type="submit">Subscribe</button> 
                </form> 
              </div> 
            </div> 
          </div> 
        </div> 
        <div class="row"> 
          <div class="col-md-12"> 
            <div class="full"> 
              <div class="footer-social-icons"> 
                <ul> 
                  <li><a href="#"><i class="fa fa-facebook"></i></a></li> 
                  <li><a href="#"><i class="fa fa-twitter"></i></a></li> 
                  <li><a href="#"><i class="fa fa-google-plus"></i></a></li> 
                  <li><a href="#"><i class="fa fa-youtube"></i></a></li> 
                  <li><a href="#"><i class="fa fa-linkedin"></i></a></li> 
                </ul> 
              </div> 
              <div class="footer-menu"> 
                <ul> 
                  <li><a href="index.php">Home</a></li> 
                  <li><a href="Pages/all_posts.php">Posts</a></li> 
                  <li><a href="Pages\about.php">About Us</a></li> 
                  <li><a href="Pages\contact.php">Contact Us</a></li> 
                  <li><a href="Pages\privacypolicy.php">Privacy Policy</a></li> 
                  <li><a href="Pages\termsandconditions.php">Terms & Conditions</a></li> 
                </ul> 
              </div> 
              <div class="footer-bottom"> 
                <p>Designed and developed by <a href="#">Your Company Name</a></p> 
              </div> 
            </div> 
          </div> 
        </div> 
      </div> 
    </div> 
  </footer> 

  <script src="js/jquery.min.js"></script> 
  <script src="js/popper.min.js"></script> 
  <script src="js/bootstrap.min.js"></script> 
  <script src="js/custom.js"></script> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script> 
</body> 

</html>