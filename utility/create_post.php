<?php
session_start();
require_once 'db_connection.php';
require_once 'functions.php';


if (empty($_POST["name"]) || empty($_POST["description"]) || empty($_POST["price"]) || empty($_FILES["picture"]["name"])) {
    die("Missing required field(s)");
}

$title = htmlspecialchars($_POST["name"]);
$description = htmlspecialchars($_POST["description"]);
$price = htmlspecialchars($_POST["price"]);
$picture = $_FILES["picture"];

if (!is_valid_picture($picture)) {
    $_SESSION["message"] = "Invalid picture file";
}

$picture_path = move_picture_to_upload_directory($picture);

if (add_car_selling_post($title, $description, $price, $picture_path, $_SESSION["user_id"])) {
    $_SESSION['message'] = 'New record created successfully';
    $_SESSION['message_type'] = 'success';
    header("Location: ../index.php");
    exit();
} else {
    $_SESSION['message'] = 'Error: Unable to create new record';
    $_SESSION['message_type'] = 'error';
    header("Location: $_SERVER[PHP_SELF] ");
    exit();
}
