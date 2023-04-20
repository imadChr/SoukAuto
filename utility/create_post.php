<?php
session_start();
require_once 'db_connection.php';

// Validate user input
if (empty($_POST["name"]) || empty($_POST["description"]) || empty($_POST["price"]) || empty($_FILES["picture"]["name"])) {
    die("Missing required field(s)");
}

// Get user input
$title = $_POST["name"];
$description = $_POST["description"];
$price = $_POST["price"];
$picture = $_FILES["picture"];

// Validate picture file
if (!is_uploaded_file($picture["tmp_name"]) || !in_array($picture["type"], ["image/png", "image/jpeg"])) {
    die("Invalid picture file");
}

// Set file path
$target_dir = "../images/uploads/";
$dir = "images/uploads/";
$target_file = $target_dir . basename($picture["name"]);
$target = $dir . basename($picture["name"]);
$picture_path = $target;

// Move file to target directory
if (!move_uploaded_file($picture["tmp_name"], $target_file)) {
    die("Error uploading file");
}



// Prepare statement
$stmt = $conn->prepare("INSERT INTO car_selling_posts (title, description, price, image_url, user_id) VALUES (?, ?, ?, ?, ?)");

// Bind parameters
$stmt->bind_param("ssdsi", $title, $description, $price, $picture_path, $_SESSION["user_id"]);

// Execute statement
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close statement and database connection
$stmt->close();
$conn->close();

// Return to index.php file 
header("Location: ../index.php");
exit();
