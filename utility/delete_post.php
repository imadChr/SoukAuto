<?php
session_start();
require_once 'db_connection.php';
require_once 'functions.php';

if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
    $post_id = $_GET["post_id"];
    if (deletePost($conn, $user_id, $post_id)) {
        $_SESSION["message"] = "Post deleted successfully";
        header("Location: ../index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
        header("Location: ../index.php");
        exit;
    }
} else {
    echo "You are not authorized to delete this post.";
}
