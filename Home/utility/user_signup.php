<?php
session_start();

require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $number = $_POST['PhoneNumber'];

    // Validate user input
    $errors = [];

    if (empty($_POST['firstname'])) {
        $errors[] = 'Please enter your first name.';
    } else if (!preg_match('/^[a-zA-Z]+$/', $_POST['firstname'])) {
        $errors[] = 'Please enter a valid first name.';
    }

    if (empty($_POST['lastname'])) {
        $errors[] = 'Please enter your last name.';
    } else if (!preg_match('/^[a-zA-Z]+$/', $_POST['lastname'])) {
        $errors[] = 'Please enter a valid last name.';
    }

    if (empty($_POST['email'])) {
        $errors[] = 'Please enter your email address.';
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }

    if (empty($_POST['password'])) {
        $errors[] = 'Please enter a password.';
    } else if (strlen($_POST['password']) < 8) {
        $errors[] = 'Password must be at least 8 characters long.';
    }

    if (empty($_POST['PhoneNumber'])) {
        $errors[] = 'Please enter your phone number.';
    } else if (!preg_match('/^\d+$/', $_POST['PhoneNumber'])) {
        $errors[] = 'Please enter a valid phone number.';
    }

    // If there are errors, display them to the user
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo '<div class="alert alert-danger">' . $error . '</div>';
        }
    } else {
        // The user input is valid, continue with the signup process
        // ...



        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (firstname, lastname, email, password, PhoneNumber) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssss', $firstname, $lastname, $email, $hashed_password, $number);

        if ($stmt->execute()) {
            $_SESSION['message'] = 'New user created successfully';
            $_SESSION['message_type'] = 'success';
        } else {
            $_SESSION['message'] = 'Error creating user: ' . $conn->error;
            $_SESSION['message_type'] = 'error';
        }

        $stmt->close();
        $conn->close();

        header("Location: ../index.php");
        exit();
    }
}
