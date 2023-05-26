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
  <?php include 'Pages/header.php'; ?>
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
      
    </div>
  </div>

  <?php include 'Pages/footer.php'; ?>
</body>

</html>