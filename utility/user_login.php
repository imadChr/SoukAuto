<?php
session_start();
require_once 'db_connection.php';
require_once 'functions.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['user_id'])) {
        header("Location: ../index.php");
        exit();
    } else {
        $email = trim($_POST["email"] ?? "");
        $password = trim($_POST["password"] ?? "");
        login($email, $password);
    }
}
