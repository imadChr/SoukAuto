<?php
session_start();

require_once 'db_connection.php';
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $number = $_POST['PhoneNumber'];
    $wilaya = $_POST['wilaya'];


    $is_valid = validate_user_input($firstname, $lastname, $email, $password, $number, $wilaya);
    if (is_string($is_valid)) {
        $_SESSION['message'] = $is_valid;
        header("Location: ../Pages/signup.php");
        exit();
    } else {
        create_user($firstname, $lastname, $email, $password, $number, $wilaya);
    }
}
