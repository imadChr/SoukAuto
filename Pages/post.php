<?php
session_start();
require_once('../utility/db_connection.php');

if (!isset($_GET['id'])) {
  die('Post ID parameter is missing');
}

$sql = "SELECT * from post inner join car on post.car_id = car.car_id inner join brand on car.brand_id = brand.brand_id inner join model on car.model_id = model.model_id inner join images on images.post_id = post.post_id  where post.post_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_GET['id']);
$stmt->execute();
$result = $stmt->get_result();


if ($result->num_rows == 0) {
  die('Post not found');
}

$post = $result->fetch_assoc();
?>



<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

  <meta charset="utf-8">
  <title><?php echo $post['title'] ?></title>
  <link rel="stylesheet" href="../css/post.css">
</head>

<body>
  <?php include "header.php"; ?>
  <br><br>

  <div class="car-container">
    <div class="car-post">
      <h1 class="car-title"><?php echo $post['title']; ?></h1>
      <p class="car-description"><?php echo $post['description']; ?></p>
      <h2 class="car-price">Price: <?php echo $post['price']; ?>DA</h2>

      <div class="image-container">
        <?php
        $sql = "SELECT * FROM images WHERE post_id = ? order by image_order asc";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $_GET['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $image = $result->fetch_assoc();
        ?>
        <img class="big-image" src="../<?php echo $image['url']; ?>" alt="Main Picture">
        <div class="small-images">
          <?php
          while ($image = $result->fetch_assoc()) {
            echo '<div class="column">';
            echo '<img src="../' . $image['url'] . '" alt="Small Picture">';
            echo '</div>';
          }
          ?>
        </div>
      </div>

      <ul class="car-info">
        <li><strong><br>Specifications<br><br></strong></li>
        <li><strong>Brand:</strong> <?php echo $post['brand']; ?></li>
        <li><strong>Model:</strong> <?php echo $post['model_name']; ?></li>
        <li><strong>Fuel Type:</strong> <?php echo $post['fuel']; ?></li>
        <li><strong>Year:</strong> <?php echo $post['year']; ?></li>
        <li><strong>Mileage:</strong> <?php echo $post['mileage']; ?> km</li>
        <li><strong>Wilaya:</strong> <?php echo $post['wilaya']; ?></li>
        <li><strong>Date of post:</strong> <?php echo date('d/m/Y', strtotime($post['date'])); ?></li>
      </ul>

    </div>
  </div>
  <br><br>
  <?php include "footer.php"; ?>
</body>

</html>