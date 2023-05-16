<?php
session_start();

require_once 'db_connection.php';
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $number = $_POST['PhoneNumber'];
    $wilaya = $_POST['wilaya'];

    if (validate_user_input($firstname, $lastname, $email, $password, $number)) {

        create_user($firstname, $lastname, $email, $password, $number, $wilaya);
    }
}
