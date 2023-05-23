<?php

session_start();
require_once('../utility/db_connection.php');

if (!isset($_GET['id'])) {
    die('Post ID parameter is missing');
}
$postID = $_GET['id']; // Set the $postID variable
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

<?php

if (isset($_POST['post_comment'])) {

    $name = $_POST['name'];
    $message = $_POST['message'];
    $postID = $_GET['id'];
    $sql = "INSERT INTO demo (name, message, post_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $name, $message, $postID);

    if ($stmt->execute()) {
        echo "";
    } else {
        echo "Error: " . $stmt->error;
    }
}
if (isset($_GET['delete_comment'])) {
    $commentID = $_GET['delete_comment'];

    $sql = "DELETE FROM demo WHERE comment_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $commentID);

    if ($stmt->execute()) {
        echo "";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

  <meta charset="utf-8">
  <title><?php echo $post['title'] ?></title>
  <link rel="stylesheet" href="../css/post.css">
</head>

<body>
<header><?php include "header.php"; ?></header>
<br><br>

<div class="car-container">
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
<br><br>
<div class="comment-section">
    <div class="wrapper">
        <h2>Add a comment</h2>
        <form action="" method="post" class="form">
            <input type="text" class="name" name="name" placeholder="Name">
            <br>
            <textarea name="message" cols="30" rows="10" class="message" placeholder="Message"></textarea>
            <br>
            <button type="submit" class="btn" name="post_comment">Post Comment</button>
        </form>
    </div> <br>

    <?php

    $sql = "SELECT * FROM demo WHERE post_id = ? ORDER BY comment_id ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $postID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="comment">
                <h3><?php echo $row['name']; ?></h3>
                <p><?php echo $row['message']; ?></p>
                <!-- Delete button -->
                <a href="?id=<?php echo $postID; ?>&delete_comment=<?php echo $row['comment_id']; ?>">Delete</a>
            </div>
            <?php
        }
    } else {
        ?>
        <div class="comment">
            <h3 class="no-comment">No comments found.</h3>
        </div>
        <?php
    }
    ?>
</div>
<br><br>
<?php include "footer.php"; ?>
</body>

</html>