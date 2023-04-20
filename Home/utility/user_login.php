<?php
session_start();
require_once 'db_connection.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate email and password inputs
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $errors = array();

    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    if (empty($password)) {
        $errors[] = "Password is required";
    }

    // If there are no errors, proceed with login
    if (empty($errors)) {
        $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $stored_password = $row["password"];

            if (password_verify($password, $stored_password)) {
                $_SESSION["user_id"] = $row["id"];
                header("Location: ../index.php");
                exit;
            } else {
                $errors[] = "Invalid email address or password";
            }
        } else {
            $errors[] = "Invalid email address or password";
        }
    }

    // Display errors if there are any
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }
}

mysqli_close($conn);
