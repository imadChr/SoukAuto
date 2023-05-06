<?php
require_once('functions.php');

// Get the post variables
$title = $_POST['title'];
$description = $_POST['description'];
$price = $_POST['price'];
$user_id = $_SESSION['user_id'];
$brand_id = $_POST['brand_id'];
$model_id = $_POST['model_id'];
$fuel = $_POST['fuel'];
$year = $_POST['year'];
$mileage = $_POST['mileage'];
$wilaya = $_POST['wilaya'];
$pictures = $_FILES['pictures'];

// Add the car
$car_id = add_car($brand_id, $model_id, $fuel, $year, $mileage);
if (!$car_id) {
    // Display error message or redirect to an error page
    die("Error adding car");
}

// Add the post
$post_id = add_post($title, $description, $price, $user_id, $car_id, $wilaya);
if (!$post_id) {
    // Display error message or redirect to an error page
    die("Error adding post");
}

// Move the pictures to the upload directory
$images_path = move_pictures_to_upload_directory($pictures);
if (!$images_path) {
    // Display error message or redirect to an error page
    die("Error moving pictures to upload directory");
}

// Insert the images to the database
if (!insert_images($post_id, $images_path)) {
    // Display error message or redirect to an error page
    die("Error inserting images to the database");
}

// Redirect to the post page
header("Location: ../pages/post.php?id=$post_id");
exit;
