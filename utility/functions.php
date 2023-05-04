<?php
session_start();
require_once "db_connection.php";

function is_valid_picture($picture)
{
    if (!is_uploaded_file($picture["tmp_name"]) || !in_array($picture["type"], ["image/png", "image/jpeg"]) || !isset($picture["tmp_name"])) {
        return false;
    }
    return true;
}


function move_picture_to_upload_directory($picture)
{
    $target_dir = "../images/uploads/";
    $dir = "images/uploads/";
    $target_file = $target_dir . basename($picture["name"]);
    $target = $dir . basename($picture["name"]);
    if (!move_uploaded_file($picture["tmp_name"], $target_file)) {
        error_log("Error uploading file");
        return false;
    }
    return $target;
}



function add_car_selling_post($title, $description, $price, $picture_path, $user_id)
{
    global $conn;

    // Validate input data
    if (!is_numeric($price)) {
        return false;
    }

    $stmt = $conn->prepare("INSERT INTO car_selling_posts (title, description, price, image_url, user_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdsi", $title, $description, $price, $picture_path, $user_id);

    if (!$stmt->execute()) {
        // Log or display error message
        error_log("Error inserting new car selling post: " . $stmt->error);
        $_SESSION['message'] = "Error inserting new car selling post";
        return false;
    }

    $inserted_id = $stmt->insert_id;
    $stmt->close();
    return $inserted_id;
}


function logout()
{
    // Unset all of the session variables
    $_SESSION = array();
    // Destroy the session
    session_destroy();
    // Redirect to login page
    header("location: ../index.php");
    exit();
}

function validate_inputs($email, $password)
{


    if (empty($email)) {
        $_SESSION['message'] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "Invalid email format";
    }

    if (empty($password)) {
        $_SESSION['message'] = "Password is required";
    }

    return true;
}


function login($email, $password)
{

    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $stored_password = $row["password"];

        if (password_verify($password, $stored_password)) {
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["firstname"] = $row["firstname"];
            header("Location: ../index.php");
            exit;
        } else {
            $_SESSION['message'] = "Invalid email address or password";
            header("Location: ../Pages/login.php");
            exit;
        }
    } else {
        $_SESSION['message'] = "Invalid email address or password";
        header("Location: login.php");
        exit;
    }
    return true;
}




function deletePost($user_id, $post_id)
{
    global $conn;
    $stmt = $conn->prepare("DELETE FROM car_selling_posts WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $post_id, $user_id);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}

function insert_new_user($firstname, $lastname, $email, $hashed_password, $number)
{
    global $conn;
    $sql = "INSERT INTO users (firstname, lastname, email, password, PhoneNumber) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssss', $firstname, $lastname, $email, $hashed_password, $number);
    $success = $stmt->execute();
    $stmt->close();

    return $success;
}


function check_for_existing_user($email)
{
    global $conn;
    // Validate email input
    if (empty($email)) {
        throw new InvalidArgumentException("Email cannot be empty");
    }

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);

    // Handle query preparation errors
    if (!$stmt) {
        throw new Exception("Query preparation error: " . $conn->error);
    }

    $stmt->bind_param('s', $email);

    // Handle query execution errors
    if (!$stmt->execute()) {
        throw new Exception("Query execution error: " . $stmt->error);
    }

    $result = $stmt->get_result();

    return ($result->num_rows > 0);
}



function create_user($firstname, $lastname, $email, $password, $number)
{
    global $conn;
    $user_exists = check_for_existing_user($email);

    if ($user_exists) {
        $_SESSION['message'] = 'User already exists';
        $_SESSION['message_type'] = 'error';
        header("Location: ../pages/signup.php");
        exit();
    }

    // Create new user
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $success = insert_new_user($firstname, $lastname, $email, $hashed_password, $number);

    if ($success) {
        $_SESSION['message'] = 'New user created successfully';
        $_SESSION['message_type'] = 'success';
        login($email, $password);
        header("Location: ../index.php");
        exit();
    } else {
        $_SESSION['message'] = 'Error creating user: ' . $conn->error;
        $_SESSION['message_type'] = 'error';
        header("Location: ../pages/signup.php");
    }
}

function validate_user_input($firstname, $lastname, $email, $password, $number)
{
    $errors = [];

    if (empty($firstname)) {
        $_SESSION['message'] = 'Please enter your first name.';
    } else if (!preg_match('/^([a-zA-Z]+ ?){1,3}$/', $firstname)) {
        $_SESSION['message'] = 'Please enter a valid first name using only letters.';
    }

    if (empty($lastname)) {
        $_SESSION['message'] = 'Please enter your last name.';
    } else if (!preg_match('/^[a-zA-Z]+$/', $lastname)) {
        $_SESSION['message'] = 'Please enter a valid last name using only letters.';
    }

    if (empty($email)) {
        $_SESSION['message'] = 'Please enter your email address.';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = 'Please enter a valid email address.';
    }

    if (empty($password)) {
        $_SESSION['message'] = 'Please enter a password.';
    } else if (strlen($password) < 8) {
        $_SESSION['message'] = 'Password must be at least 8 characters long.';
    }

    if (empty($number)) {
        $_SESSION['message'] = 'Please enter your phone number.';
    } else if (!preg_match('/^\d+$/', $number)) {
        $_SESSION['message'] = 'Please enter a valid phone number using only digits.';
    }

    return true;
}

function display_errors($errors)
{
    foreach ($errors as $error) {
        echo '<div class="alert alert-danger">' . $error . '</div>';
    }
}

function generatePaginationLink($page, $current_page) {
    $class = ($page == $current_page) ? 'active' : '';
    return "<li class='page-item $class'><a class='page-link' href='all_posts.php?page=$page'>$page</a></li>";
}