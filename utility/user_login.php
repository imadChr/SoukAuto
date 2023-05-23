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
        if (login($email, $password)) {
            if (isset($_SESSION['redirect_url'])) {
                header("Location: ../Pages/" . $_SESSION['redirect_url']);
                unset($_SESSION['redirect_url']);
                exit();
            } else {
                header("Location: ../index.php");
                exit();
            }
        }
    }
}
